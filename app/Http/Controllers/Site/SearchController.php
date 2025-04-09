<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use App\Models\Admin\Product;
use App\Models\Site\Seo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');

        $products = Product::query()
            ->when($category && $category !== 'all', function ($q) use ($category) {
                return $q->where('category_id', $category);
            })
            ->when($query, function ($q) use ($query) {
                return $q->where('name_ar', 'LIKE', "%$query%")
                    ->orWhere('name_en', 'LIKE', "%$query%");
            })
            ->where('is_visible', 1)
            ->get();
        return view('front.search', compact('products', 'category', 'query'));
    }
}
