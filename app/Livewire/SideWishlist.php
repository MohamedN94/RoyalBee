<?php

namespace App\Livewire;

use App\Models\Admin\Product;
use App\Models\Wishlist;
use Livewire\Component;

class SideWishlist extends Component
{
    public $confirmDeleteRowId;
    public $showConfirmationDialog = false;
    public $isInWishlist;
    public $productId;

    protected $listeners = ['wishlist_updated'];

    public function render()
    {
        if (auth()->check()) {
            $wishlists = auth()->user()->products()->get();
        } else {
            $wishlistProductIds = session()->get('wishlist', []);
            $wishlists = Product::whereIn('id', $wishlistProductIds)->get();
        }
        return view('livewire.side-wishlist', compact('wishlists'));
    }

    public function wishlist_updated($productId)
    {
        if (auth()->check()) {
            $this->isInWishlist = Wishlist::where('product_id', $productId)
                ->where('user_id', auth()->user()->id)
                ->exists();
        } else {
            $wishlist = session()->get('wishlist', []);
            $this->isInWishlist = in_array($productId, $wishlist);
        }
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
