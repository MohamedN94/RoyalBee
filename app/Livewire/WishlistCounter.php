<?php

namespace App\Livewire;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistCounter extends Component
{
    protected $listeners = ['wishlist_updated', 'render'];

    public function render()
    {
        if (auth()->check()) {
            $wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();
        } else {

            $wishlistCount = count(session()->get('wishlist', []));
        }

        return view('livewire.wishlist-counter', compact('wishlistCount'));
    }

    public function wishlist_updated($productId)
    {
        $this->render();
    }

}
