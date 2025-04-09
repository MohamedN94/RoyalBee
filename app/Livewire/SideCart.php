<?php

namespace App\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class SideCart extends Component
{
    public $confirmDeleteRowId;
    public $showConfirmationDialog = false;
    public $showSide = false;
    protected $listeners = [
        'cart_updated' => 'refreshCart',
        'update_count' => 'update_count'
    ];

    public function render()
    {
        $carts = Cart::content();
        return view('livewire.side-cart', compact('carts'));
    }

    public function updateTotal($rowId, $quantity)
    {
        $cartItem = Cart::get($rowId);
        if ($quantity > 0) {
            Cart::update($rowId, $quantity);
            $this->dispatch('updateProductQuantity', $cartItem->id, $quantity);
        } else {
            Cart::remove($rowId);
            $this->dispatch('updateProductQuantity', $cartItem->id, 0);
        }
        $this->dispatch('cart_updated');
        $this->showSide = true;
        $this->refreshCart();
        // Check if the cart is empty and refresh the page if it is
//        if ($this->carts->isEmpty()) {
//            return redirect(request()->header('Referer'));
//        }
    }

    public function refreshCart()
    {
        $this->showSide = true;
//        $this->dispatch('cart-updated');
    }

    public function removeFromCart($rowId)
    {
        $cartItem = Cart::get($rowId);

        if (!$cartItem) {
            return redirect(request()->header('Referer'));
        }

        Cart::remove($rowId);
        $this->dispatch('updateProductQuantity', $cartItem->id, 0);
        $this->dispatch('cart_updated');
        $this->refreshCart();

        // Check if the cart is empty and refresh the page if it is
//        if ($this->carts->isEmpty()) {
//            return redirect(request()->header('Referer'));
//        }
    }
}
