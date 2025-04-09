<?php

namespace App\Livewire;

use Livewire\Component;

class Cart extends Component
{
    public $confirmDeleteRowId;
    public $showConfirmationDialog = false;
    public $quantity;

    public function render()
    {
        $carts = \Gloudemans\Shoppingcart\Facades\Cart::content();
        return view('livewire.cart', compact('carts'));
    }

    public function updateTotal($rowId, $quantity)
    {
        \Gloudemans\Shoppingcart\Facades\Cart::update($rowId, $quantity);
        $this->carts = \Gloudemans\Shoppingcart\Facades\Cart::content();
        $this->dispatch('update_count');
    }

    public function removeFromCart($rowId)
    {
        \Gloudemans\Shoppingcart\Facades\Cart::remove($rowId); // Use the product ID to remove the item from the cart
        $this->carts = \Gloudemans\Shoppingcart\Facades\Cart::content();
        $this->dispatch('update_count');

        // Check if the cart is empty and refresh the page if it is
        if ($this->carts->isEmpty()) {
            return redirect(request()->header('Referer'));
        }
    }
}
