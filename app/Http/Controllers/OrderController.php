<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('orderDetails.book')->where('user_id', Auth::id())->latest()->paginate(10); // Assuming you want to paginate the orders

        return view('frontend.order', compact('orders'));
    }



    public function addToOrder(Request $request)
    {
        // Validate the request data
        $carts = Cart::with('book')->where('user_id', Auth::id())->get();
        $totalPrice = $carts->sum(function ($cartItem) {
            return $cartItem->book->price * $cartItem->quantity;
        });

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Create a new order
            $order = new Order();
            $order->user_id = Auth::id(); // Use the authenticated user's ID
            $order->price = $totalPrice;
            $order->order_date = now();
            // ... other order fields
            $order->save();

            // Add books to the order details
            foreach ($carts as $cartItem) {
                if (!$cartItem->book) {
                    throw new \Exception('Book not found');
                }

                // Calculate subtotal based on book price and quantity
                $subtotal = $cartItem->book->price * $cartItem->quantity;

                // Add the book to the order details
                $order->orderDetails()->create([
                    'book_id' => $cartItem->book->id,
                    'user_id' => Auth::id(),
                    'quantity' => $cartItem->quantity,
                    'subtotal' => $subtotal,
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Clear the user's cart after placing the order (assuming you have a method for this)
            $this->clearCart();

            return response()->json(['message' => 'Order placed successfully']);
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Method to clear the user's cart after placing an order
    private function clearCart()
    {
        Cart::with('book')->where('user_id', Auth::id())->delete();
        // Add your logic to clear the user's cart here
    }
}
