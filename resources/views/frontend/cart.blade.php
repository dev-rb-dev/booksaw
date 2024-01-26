@extends('frontend.layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Shopping Cart</h1>
        <div id="cart-items">
            <!-- Cart items will be dynamically loaded here -->
        </div>
        <div id="order_button">
            <button id="order-now-btn" class="btn btn-primary">Order Now</button>
        </div>
    </div>
@endsection
