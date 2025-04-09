<?php

namespace App\Livewire;

use App\Models\Admin\Product;
use Livewire\Component;

class Wishlists extends Component
{
    public $confirmDeleteRowId;
    public $showConfirmationDialog = false;
    public $isInWishlist;
    public $productId;
    public $quantity = 1;

    protected $listeners = ['wishlist_updated'];

    public function render()
    {
        if (auth()->check()) {
            $wishlists = auth()->user()->products()->get();
        } else {
            $wishlists = [];
        }
        return view('livewire.wishlists', compact('wishlists'));
    }

    public function wishlist_updated($productId)
    {
        if (isset($this->isInWishlist)) {
            $this->isInWishlist = Wishlists::where('product_id', $productId)
                ->where('user_id', auth()->user()?->id)
                ->exists();
        }
    }

    public function removeFromWishlist($productId)
    {
        $user = auth()->user();
        $wishlistItem = $user->products()->find($productId);

        if ($wishlistItem) {
            $user->products()->detach($productId);
            $this->dispatch('wishlist_updated', $productId);
            session()->flash('message', 'Product removed from wishlist successfully.');
        } else {
            session()->flash('error', 'Product not found in wishlist.');
        }
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        \Gloudemans\Shoppingcart\Facades\Cart::add($product->id,
            $product->name_ar,
            $this->quantity,
            $product->discount_price != null ? $product->discount_price : $product->price);
        session()->flash('success', 'cart updated!!');
        $this->dispatch('cart_updated');
    }


}
