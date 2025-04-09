<?php

namespace App\Livewire;

use App\Models\Admin\Product;
use App\Models\Wishlist;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToWishlist extends Component
{
    public $productId;
    public $isInWishlist;
    protected $listeners = ['wishlist_updated'];

    public function mount($productId)
    {
        $this->productId = $productId;
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
        return view('livewire.add-to-wishlist');
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
}
