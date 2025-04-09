<?php

namespace App\Livewire;

use App\Models\Admin\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductDetails extends Component
{
    public $product;
    public $quantity = 1;
    protected $listeners = ['updateProductQuantity' => 'setProductQuantity'];

    public function mount($productId)
    {
        $this->product = Product::findOrFail($productId);
        $cartItem = Cart::content()->where('id', $productId)->first();

        if ($cartItem) {
            $this->quantity = $cartItem->qty;
        } else {
            $this->quantity = 0;
        }
    }

    public function setProductQuantity($productId, $quantity)
    {
        if ($this->product->id == $productId) {
            $this->quantity = $quantity;
        }
    }

    public function render()
    {
        $cart = Cart::content();
        return view('livewire.product-details', compact('cart'));
    }

    public function updateTotal($productId, $newQty)
    {
        $cartItem = Cart::content()->where('id', $productId)->first();
        if ($cartItem) {
            if ($newQty > 0) {
                Cart::update($cartItem->rowId, $newQty);
            } else {
                Cart::remove($cartItem->rowId);
                $this->quantity = 0; // Set quantity to 0
            }
        } else {
            $this->quantity = 0; // Set quantity to 0 if the item is not found
        }
        $this->dispatch('updateProductQuantity', $productId,  $this->quantity);
        $this->dispatch('cart_updated');
    }

    public function addToCart()
    {
        Cart::add(
            $this->product->id,
            $this->product->name_ar,
            $this->quantity > 0 ? $this->quantity : 1,
            $this->product->price
        );

        $this->dispatch('cart_updated');
        session()->flash('success', 'Product added to cart!');
    }
}
