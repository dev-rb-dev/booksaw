<!-- Navbar -->
<!-- End Navbar -->
<div>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <div class="pt-4 mb-3">
                            @if ($editBookId == null)
                                <form wire:submit.prevent="create" class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" wire:model="title" placeholder="Title">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" wire:model="author" placeholder="Author">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" wire:model="genre" placeholder="Genre">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" wire:model="price" placeholder="Price">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" wire:model="photo" placeholder="Photo URL">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" wire:model="quantity_available"
                                            placeholder="Quantity Available">
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Add Book</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- <div class=" me-3 my-3 text-end">
                    <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i
                            class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                        User</a>
                </div> --}}
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <!-- Book creation form -->

                        <!-- Book list with edit forms -->
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Author</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Genre</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Price</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Photo url</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Quantity Available</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books ?? [] as $book)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm"> {{ $book->id }} </h6>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                @if ($editBookId !== $book->id)
                                                    <h6 class="mb-0 text-sm"> {{ $book->title }} </h6>
                                                @else
                                                    <input type="text" class="form-control" wire:model="title">
                                                @endif
                                            </div>

                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                @if ($editBookId !== $book->id)
                                                    <h6 class="mb-0 text-sm"> {{ $book->author }} </h6>
                                                @else
                                                    <input type="text" class="form-control" wire:model="author">
                                                @endif
                                            </div>

                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                @if ($editBookId !== $book->id)
                                                    <h6 class="mb-0 text-sm"> {{ $book->genre }} </h6>
                                                @else
                                                    <input type="text" class="form-control" wire:model="genre">
                                                @endif
                                            </div>

                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                @if ($editBookId !== $book->id)
                                                    <h6 class="mb-0 text-sm"> {{ $book->price }} </h6>
                                                @else
                                                    <input type="text" class="form-control" wire:model="price">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                @if ($editBookId !== $book->id)
                                                    <h6 class="mb-0 text-sm"> {{ $book->photo }} </h6>
                                                @else
                                                    <input type="text" class="form-control" wire:model="photo">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center">
                                                @if ($editBookId !== $book->id)
                                                    <h6 class="mb-0 text-sm"> {{ $book->quantity_available }} </h6>
                                                @else
                                                    <input type="text" class="form-control"
                                                        wire:model="quantity_available">
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if ($editBookId !== $book->id)
                                                <button wire:click="edit({{ $book->id }})">Edit</button>
                                            @else
                                                <button wire:click="update">Update</button>
                                                <button wire:click="editCancel">Cancel</button>
                                            @endif
                                            <button wire:click="delete({{ $book->id }})">Delete</button>
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
