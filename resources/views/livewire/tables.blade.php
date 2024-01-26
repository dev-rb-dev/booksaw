    <div class="">
        <!-- Navbar -->
        <!-- End Navbar -->
        <div class="container-fluid py-4">

            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Orders table</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Amount</th>
                                            <th>Books</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>${{ number_format($order->price, 2) }}</td>
                                                <td>
                                                    @forelse ($order->orderDetails as $item)
                                                        <span>{{ Str::limit($item->book->title, 20) }}</span><!-- Limit to 20 characters -->
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                        <!-- Add a comma if it's not the last item -->
                                                    @empty
                                                        No books
                                                    @endforelse
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
