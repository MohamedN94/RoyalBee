<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Site\Service;
use Illuminate\View\View;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class CollectionController extends Controller
{
    use SEOToolsTrait;

    function index(): View
    {
//        $collection= Seo::where('id',4)->first();
//        $this->seo()->setTitle($collection-> meta_title);
//        $this->seo()->setDescription($collection->meta_description);
//        $this->seo()->opengraph()->setUrl($collection->meta_canonical);
//        $this->seo()->opengraph()->addProperty('type', $collection->meta_property);
//        $this->seo()->twitter()->setSite($collection->meta_twitter);
//        $this->seo()->jsonLd()->setType($collection->meta_jsonLd);
//        SEOMeta::addKeyword($collection->meta_Keyword);
        $collections = Category::select(['id', 'name_ar', 'image', 'slug'])->get();

        return view('front.collections', compact('collections'));
    }

    function show($slug): View
    {
        $collection = Category::whereSlug($slug)->first();
        $products = Product::where('category_id', $collection->id)
            ->select(['id', 'name_ar', 'description_ar', 'image', 'price', 'discount_price'])
            ->with(['photos', 'category'])
            ->get();
        return view('front.show-collection', compact('products','collection'));
    }
}
