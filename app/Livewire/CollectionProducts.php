<?php

namespace App\Livewire;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CollectionProducts extends Component
{
    public array $quantity = [];
    public $products;
    public $slug;


    public function mount($slug)
    {
        $this->slug = $slug;
        $collection = Category::whereSlug($slug)->first();
        $this->products = Product::where('category_id', $collection->id)
            ->select(['id', 'name_ar', 'description_ar', 'image', 'price', 'discount_price','slug'])
            ->with(['category'])
            ->get();
        foreach ($this->products as $product) {
            $this->quantity[$product->id] = 1;
        }
    }
    public function render()
    {
        $cart = Cart::content();
        return view('livewire.collection-products', compact('cart'));
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        Cart::add($product->id,
            $product->name_ar,
            $this->quantity[$product->id],
            $product->price);
        $this->dispatch('cart_updated');
        session()->flash('success', 'cart updated!!');
    }
}
