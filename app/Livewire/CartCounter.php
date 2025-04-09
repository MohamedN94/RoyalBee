<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartCounter extends Component
{
    protected $listeners = ['cart_updated', 'render' ,'update_count'];

    public function render()
    {
        $cartCount = Cart::count();
        return view('livewire.cart-counter', compact('cartCount'));
    }

}
