@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <h1>Order List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Name</th>
                    <th>Price</th>
                    <th>Date</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            {{-- {{ $order->orderDetails }} --}}
                            @forelse ($order->orderDetails as $item)
                                <p> {{ $item->book->title }}</p>
                            @empty
                            @endforelse
                        </td>
                        <td>${{ number_format($order->price, 2) }}</td>
                        <td>{{ date('Y-m-d', strtotime($order->order_date)) }}</td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }} <!-- Pagination links -->
    </div>
@endsection
