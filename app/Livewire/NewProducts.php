<?php

namespace App\Livewire;

use App\Models\Admin\Product;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class NewProducts extends Component
{
    public array $quantity = [];
    public array $isInWishlist = [];
    public $products;
    protected $listeners = ['wishlist_updated'];

    public function mount()
    {
        $this->products = Product::select(['id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'slug', 'image', 'price', 'discount_price'])
            ->where('is_visible', 1)
            ->latest()
            ->take(6)
            ->get();
            
        foreach ($this->products as $product) {
            $this->quantity[$product->id] = 1;
            if (auth()->check()) {
                $this->isInWishlist[$product->id] = Wishlist::where('product_id', $product->id)
                    ->where('user_id', auth()->user()->id)
                    ->exists();
            } else {
                $wishlist = session()->get('wishlist', []);
                $this->isInWishlist[$product->id] = in_array($product->id, $wishlist);
            }
        }
    }

    public function wishlist_updated($productId)
    {
        if (isset($this->isInWishlist[$productId])) {
            if (auth()->check()) {
                $this->isInWishlist[$productId] = Wishlist::where('product_id', $productId)
                    ->where('user_id', auth()->user()->id)
                    ->exists();
            } else {
                $wishlist = session()->get('wishlist', []);
                $this->isInWishlist[$productId] = in_array($productId, $wishlist);
            }
        }
    }

    public function render()
    {
        $cart = Cart::content();
        return view('livewire.new-products', compact('cart'));
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        Cart::add($product->id,
            $product->name_ar,
            $this->quantity[$product->id],
            $product->discount_price != null ? $product->discount_price : $product->price);
        $this->dispatch('cart_updated');
        session()->flash('success', 'Cart updated!!');
    }

    public function addToWishlist($productId)
    {
        if (auth()->check()) {
            // Handle wishlist for authenticated users
            $wishlistItem = Wishlist::where('product_id', $productId)
                ->where('user_id', auth()->user()->id)
                ->first();

            if (!$wishlistItem) {
                Wishlist::create([
                    'product_id' => $productId,
                    'user_id' => auth()->user()->id
                ]);
                $this->isInWishlist[$productId] = true;
            } else {
                auth()->user()->products()->detach($productId);
                $this->isInWishlist[$productId] = false;
            }
        } else {
            // Handle wishlist for guest users using session
            $wishlist = session()->get('wishlist', []);
            if (!in_array($productId, $wishlist)) {
                session()->push('wishlist', $productId);
                $this->isInWishlist[$productId] = true;
            } else {
                session()->put('wishlist', array_diff($wishlist, [$productId]));
                $this->isInWishlist[$productId] = false;
            }
        }

        $this->dispatch('wishlist_updated', $productId);
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
