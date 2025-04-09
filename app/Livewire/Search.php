<?php

namespace App\Livewire;

use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public array $quantity = [];
    public array $isInWishlist = []; // Track wishlist status for each product
    public $category;
    public $query;
    public $minPrice = 0;
    public $maxPrice = 50000;
    public $perPage = 24;
    public $sortBy = 'default';
    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['minPrice', 'maxPrice', 'perPage', 'sortBy'];

    public function mount($category = null, $query = null)
    {
        $this->category = $category;
        $this->query = $query;
        $this->products = Product::query()
            ->when($category && $category !== 'all', function ($q) use ($category) {
                return $q->where('category_id', $category);
            })
            ->when($query, function ($q) use ($query) {
                return $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('name_ar', 'LIKE', "%$query%")
                        ->orWhere('name_en', 'LIKE', "%$query%");
                });
            })
            ->when($this->minPrice || $this->maxPrice, function ($q) {
                return $q->whereBetween('price', [$this->minPrice, $this->maxPrice]);
            })
            ->where('is_visible', 1)
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
    }

    public function updated()
    {
        $this->resetPage();
    }

    public function updatedMinPrice()
    {
        $this->resetPage();
    }

    public function updatedMaxPrice()
    {
        $this->resetPage();
    }

    public function render()
    {
        $categories = Category::all();
        $query = Product::query();
        if (!is_null($this->category) && $this->category !== 'all') {
            $query->where('category_id', $this->category);
        }

        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
        if ($this->sortBy === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sortBy === 'price_desc') {
            $query->orderBy('price', 'desc');
        }
        if (!is_null($this->query) && $this->query !== '') {
            $query->where(function ($q) {
                $q->where('name_ar', 'LIKE', "%{$this->query}%")
                    ->orWhere('name_en', 'LIKE', "%{$this->query}%");
            });
        }

        $products = $query->where('is_visible', 1)->orderBy('created_at', 'desc')->paginate($this->perPage);


        foreach ($products as $product) {
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

        return view('livewire.search', compact('products', 'categories'));
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        \Gloudemans\Shoppingcart\Facades\Cart::add($product->id,
            $product->name_ar,
            $this->quantity[$product->id],
            $product->discount_price != null ? $product->discount_price : $product->price);
        $this->dispatch('cart_updated');
        session()->flash('success', 'Cart updated!!');
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
                $this->isInWishlist[$productId] = true;
            } else {
                auth()->user()->products()->detach($productId);
                $this->isInWishlist[$productId] = false;
            }
        } else {
            // For guests, handle the wishlist in the session
            $wishlist = session()->get('wishlist', []);

            if (!in_array($productId, $wishlist)) {
                $wishlist[] = $productId;
                session()->put('wishlist', $wishlist);
                $this->isInWishlist[$productId] = true;
            } else {
                $wishlist = array_diff($wishlist, [$productId]);
                session()->put('wishlist', $wishlist);
                $this->isInWishlist[$productId] = false;
            }
        }

        $this->dispatch('wishlist_updated', $productId);
    }

    public function removeFromWishlist($productId)
    {
        if (auth()->check()) {
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
