<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Component;
use Livewire\WithPagination;

class BookManage extends Component
{
    // use WithPagination;

    public $books;
    public $title;
    public $author;
    public $genre;
    public $price;
    public $photo;
    public $quantity_available;
    public $editBookId;

    public function mount()
    {
        $this->books = Book::latest()->get();
    }

    public function render()
    {

        // $this->books = Book::latest()->paginate(10);

        return view('livewire.book-manage', [
            'books' => $this->books ,
        ]);
    }

    public function create()
    {
        Book::create([
            'title' => $this->title,
            'author' => $this->author,
            'genre' => $this->genre,
            'photo' => $this->photo,
            'price' => $this->price,
            'quantity_available' => $this->quantity_available,
        ]);

        $this->resetFields();
        $this->mount();
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $this->editBookId = $book->id;
        $this->title = $book->title;
        $this->author = $book->author;
        $this->photo = $book->photo;
        $this->genre = $book->genre;
        $this->price = $book->price;
        $this->quantity_available = $book->quantity_available;
    }

    public function update()
    {
        $book = Book::findOrFail($this->editBookId);
        $book->update([
            'title' => $this->title,
            'author' => $this->author,
            'genre' => $this->genre,
            'photo' => $this->photo,
            'price' => $this->price,
            'quantity_available' => $this->quantity_available,
        ]);

        $this->resetFields();
        $this->editBookId = null;
        $this->mount();
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        $this->mount();
    }

    public function editCancel(){
        $this->editBookId = null;
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->title = '';
        $this->author = '';
        $this->genre = '';
        $this->photo = '';
        $this->price = '';
        $this->quantity_available = '';
    }
}
