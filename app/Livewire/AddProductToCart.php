<?php

namespace App\Livewire;

use App\Models\Admin\Product;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddProductToCart extends Component
{
    public $productId;
    public $quantity = 1;
    public  $isInWishlist; // Track wishlist status for each product

    protected $listeners = ['wishlist_updated'];

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->product = Product::find($productId);
        if (auth()->check()) {
            $this->isInWishlist = Wishlist::where('product_id', $this->productId)
                ->where('user_id', auth()->user()->id)
                ->exists();
        } else {
            // Check if the product is in the session for guests
            $wishlist = session()->get('wishlist', []);
            $this->isInWishlist = in_array($this->productId, $wishlist);
        }
    }

    public function render()
    {
        $product = Product::find($this->productId);

        return view('livewire.add-product-to-cart',compact('product'));
    }

    public function wishlist_updated($productId)
    {
        if ($this->productId == $productId) {
            if (auth()->check()) {
                $this->isInWishlist = Wishlist::where('product_id', $this->productId)
                    ->where('user_id', auth()->user()->id)
                    ->exists();
            } else {
                $wishlist = session()->get('wishlist', []);
                $this->isInWishlist = in_array($this->productId, $wishlist);
            }
        }
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        Cart::add($product->id,
            $product->name_ar,
            $this->quantity,
            $product->discount_price != null ? $product->discount_price : $product->price);
        $this->dispatch('cart_updated');
        session()->flash('success', 'Product added to cart');
    }

    public function addToWishlist($productId)
    {
        if (auth()->check()) {
            $wishlistItem = Wishlist::where('product_id', $productId)
                ->where('user_id', auth()->user()->id)
                ->first();

            if (!$wishlistItem) {
                Wishlist::create([
                    'product_id' => $productId,
                    'user_id' => auth()->user()->id
                ]);
                $this->isInWishlist = true;
            } else {
                auth()->user()->products()->detach($productId);
                $this->isInWishlist = false;
            }
        } else {
            // For guests, handle the wishlist in the session
            $wishlist = session()->get('wishlist', []);

            if (!in_array($productId, $wishlist)) {
                $wishlist[] = $productId;
                session()->put('wishlist', $wishlist);
                $this->isInWishlist = true;
            } else {
                $wishlist = array_diff($wishlist, [$productId]);
                session()->put('wishlist', $wishlist);
                $this->isInWishlist = false;
            }
        }
        $this->dispatch('wishlist_updated', $this->productId);
        session()->flash('success', 'wishlist updated!!');
    }
    public function removeFromWishlist($productId)
    {
        if (auth()->check()) {
            // Remove product from wishlist for authenticated users
            $wishlistItem = auth()->user()->products()->find($productId);

            if ($wishlistItem) {
                auth()->user()->products()->detach($productId);
                $this->dispatch('wishlist_updated', $productId);
                session()->flash('message', 'Product removed from wishlist successfully.');
            } else {
                session()->flash('error', 'Product not found in wishlist.');
            }
        } else {
            // Remove product from wishlist for guests (session-based)
            $wishlist = session()->get('wishlist', []);
            if (in_array($productId, $wishlist)) {
                session()->put('wishlist', array_diff($wishlist, [$productId]));
                $this->dispatch('wishlist_updated', $productId);
                session()->flash('message', 'Product removed from wishlist successfully.');
            } else {
                session()->flash('error', 'Product not found in wishlist.');
            }
        }
    }
}
