<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Page;
use App\Models\Admin\Product;
use App\Models\Contact;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use App\Models\Admin\Review;
use App\Models\Site\Seo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class WishlistController extends Controller
{
    use SEOToolsTrait;

    function index(): View
    {
        if (auth()->check()) {
            $wishlists = auth()->user()->products()->get();
        } else {
            $wishlists = [];
        }
        return view('front.wishlist', compact('wishlists'));
    }

    public function getProductsByCollection(Request $request)
    {
        $collectionId = $request->get('collection_id');
        $collection = Category::with('products')->find($collectionId);

        if (!$collection) {
            return response()->json(['error' => 'Collection not found'], 404);
        }

        return view('front.partials.products-list', ['products' => $collection->products])->render();
    }

    public function review(Request $request)
    {
        $productId = $request->input('product_id');
        $rating = $request->input('rating');
        $userId = auth()->id();

        // Check if the user has already reviewed this product
        $existingReview = Review::where('product_id', $productId)->where('user_id', $userId)->first();

        if ($existingReview) {
            // Update existing review
            $existingReview->rating = $rating;
            $existingReview->save();
            $review = $existingReview;
        } else {
            // Create a new review
            $review = new Review();
            $review->product_id = $productId;
            $review->user_id = $userId;
            $review->rating = $rating;
            $review->save();
        }

        return response()->json([
            'status' => 'success',
            'review' => $review,
        ]);
    }


}
