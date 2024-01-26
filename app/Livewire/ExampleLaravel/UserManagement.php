<?php

namespace App\Livewire\ExampleLaravel;

use App\Models\User;
use Livewire\Component;

class UserManagement extends Component
{
    public $users;

    public function mount()
    {
        // Fetch users from the database
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.example-laravel.user-management', [
            'users' => $this->users,
        ]);
    }
}
