<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        $books = Book::latest()->limit(20)->get();
        $featured = Book::latest()->limit(4)->get();
        return view('frontend.home', compact('books','featured'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        $recommendedBooks = $this->getRecommendedBooks($user);

        // Get the user's purchase history
        $userId = Auth::id();

        // Get the user's purchase history
        $userPurchases = OrderDetails::where('user_id', $userId)->pluck('book_id');

        // Get recommended books based on the user's purchase history (e.g., books with similar genres)
        $recommendedBooks = Book::whereIn('genre', function ($query) use ($userPurchases) {
            $query->select('genre')
                ->from('books')
                ->whereIn('id', $userPurchases);
        })
        ->whereNotIn('id', $userPurchases) // Exclude books the user has already purchased
        ->take(5) // Limit the number of recommendations
        ->get();
        // dd($recommendedBooks);
        return view('frontend.dashboard', compact('recommendedBooks'));
    }

    public function getRecommendedBooks(User $user)
    {
        // Get the user's purchase history
        $userPurchases = $user->purchases()->pluck('book_id');

        // Find other users who purchased the same books
        $similarUsers = OrderDetails::whereIn('book_id', $userPurchases)
            ->where('user_id', '!=', $user->id)
            ->distinct('user_id')
            ->pluck('user_id');
            // dd($similarUsers );
        // Get books purchased by similar users but not by the current user
        $recommendedBooks = OrderDetails::whereIn('user_id', $similarUsers)
            ->whereNotIn('book_id', $userPurchases)
            ->select('book_id', DB::raw('count(*) as total_purchases'))
            ->groupBy('book_id')
            ->orderByDesc('total_purchases')
            ->limit(5) // Limit the number of recommendations
            ->get();

        return $recommendedBooks;
    }
}
