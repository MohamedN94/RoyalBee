<?php

namespace App\Livewire;

use App\Models\Admin\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToCart extends Component
{
    public $productId;
    public $quantity = 1;


    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        Cart::add($product->id,
            $product->name_ar,
            $this->quantity,
            $product->discount_price != null ? $product->discount_price : $product->price);
        $this->dispatch('cart_updated');
        session()->flash('success', 'cart updated!!');
    }
}
