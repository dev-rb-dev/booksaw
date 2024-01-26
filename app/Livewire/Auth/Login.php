<?php

namespace App\Livewire\Auth;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{

    public $email='';
    public $password='';

    protected $rules= [
        'email' => 'required|email',
        'password' => 'required'

    ];

    public function render()
    {

        return view('livewire.auth.login');
    }

    public function mount() {

        $this->fill(['email' => 'admin@demo.com', 'password' => 'password']);
    }

    public function store()
    {
        $attributes = $this->validate();
        // dd($attributes);
        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }

        session()->regenerate();

        return redirect('/dashboard');

    }
}
