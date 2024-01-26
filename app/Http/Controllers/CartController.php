<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $itemId = $request->input('itemId');
        $quantity = $request->input('quantity');

        // Find the cart item by ID
        $cartItem = Cart::find($itemId);

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        // Update the quantity
        $cartItem->quantity =$quantity;
        $cartItem->save();

        return response()->json(['message' => 'Cart item quantity updated successfully', 'cartItem' => $cartItem]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($itemId)
    {
        // Find the cart item by ID
        $cartItem = Cart::find($itemId);

        if (!$cartItem) {
            return response()->json(['error' => 'Cart item not found'], 404);
        }

        // Delete the cart item
        $cartItem->delete();

        return response()->json(['message' => 'Cart item deleted successfully']);
    }

    public function cart(){
        return view('frontend.cart');
    }

    public function cartLoad(Request $request){

        $user = auth()->user();

        $cartItems = $user->carts()->with('book')->get();

        return response()->json(['cartItems' => $cartItems]);
    }
    public function addToCart(Request $request){
        $userId = auth()->id(); // Assuming the user is authenticated
        $bookId = $request->input('book_id');
        $quantity = $request->input('quantity', 1);

        // Check if the item already exists in the cart for the user
        $cartItem = Cart::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->first();

        if ($cartItem) {
            // If the item exists, update the quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // If the item doesn't exist, create a new cart item
            $cartItem = new Cart([
                'user_id' => $userId,
                'book_id' => $bookId,
                'quantity' => $quantity,
            ]);
            $cartItem->save();
        }

        return response()->json(['message' => 'Item added to cart']);
    }

    public function cartCount(){
        $user = auth()->user();

        $cartICount = $user->carts()->count();

        return response()->json(['cartICount' => $cartICount]);
    }
}
