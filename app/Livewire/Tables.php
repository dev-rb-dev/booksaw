<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class Tables extends Component
{
    public $orders;

    public function mount()
    {
        // Retrieve all orders from the Order model
        $this->orders = Order::latest()->get();
    }

    public function render()
    {
        return view('livewire.tables', [
            'orders' => $this->orders,
        ]);
    }
}
