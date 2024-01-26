@extends('frontend.layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Recommended Books</h2>
        <ul>
            @forelse ($recommendedBooks as $book)
                <li>{{ $book->title }}</li>
            @empty
                <p>No recommended books available.</p>
            @endforelse
        </ul>
    </div>
@endsection
