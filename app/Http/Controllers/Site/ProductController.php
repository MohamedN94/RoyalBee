<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Page;
use App\Models\Admin\Product;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use App\Models\Admin\Country;
use App\Models\Admin\Review;
use App\Models\Site\Seo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class ProductController extends Controller
{
    use SEOToolsTrait;

    function show($slug): View
    {
//        $service = Seo::where('id', 2)->first();
//        $this->seo()->setTitle($service->meta_title);
//        $this->seo()->setDescription($service->meta_description);
//        $this->seo()->opengraph()->setUrl($service->meta_canonical);
//        $this->seo()->opengraph()->addProperty('type', $service->meta_property);
//        $this->seo()->twitter()->setSite($service->meta_twitter);
//        $this->seo()->jsonLd()->setType($service->meta_jsonLd);
//        SEOMeta::addKeyword($service->meta_Keyword);
        $product = Product::where('slug', $slug)
            ->select(['id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'image', 'price', 'discount_price', 'slug',
                'category_id', 'review', 'video', 'best_seller', 'sale_start_date', 'sale_end_date', 'short_desc_en', 'short_desc_ar'
                , 'meta_title_ar', 'meta_title_en', 'meta_description_ar', 'meta_description_en', 'alt_image','type'])
            ->with('photos:id,photo,product_id')
            ->first();
        if (!$product) {
            abort(404);
        }
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_visible', 1)
            ->take(12)
            ->get();
        $countries = Country::all();
        // dd($product);
        return view('front.product', compact('product', 'relatedProducts','countries'));
    }

    public function getStatesByCountry(Request $request)
    {
        $countryId = $request->input('country_id');
        $country = Country::with('states')->find($countryId);
        return response()->json([
            'country' => $country,
            'states' => $country->states
        ]);
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
