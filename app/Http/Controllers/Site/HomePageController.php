<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterRequest;
use App\Models\Admin\Blog;
use App\Models\Admin\Category;
use App\Models\Admin\FeaturedCategory;
use App\Models\Admin\Product;
use App\Models\Admin\Reel;
use App\Models\Admin\Slider;
use App\Models\NewsLetter;
use App\Models\Site\Seo;
use App\Models\Site\Service;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class HomePageController extends Controller
{
    use SEOToolsTrait;

    public function index()
    {
        // dd(app()->getLocale());
        //$service = Seo::where('id', 1)->first();
        $this->seo()->setTitle('');
        $this->seo()->setDescription('');
        $this->seo()->opengraph()->setUrl('');
        $this->seo()->opengraph()->addProperty('type', '');
        $this->seo()->twitter()->setSite('');
        $this->seo()->jsonLd()->setType('');
        SEOMeta::addKeyword('');
        $sliders = Slider::where('status',1)->select(['id', 'title_ar', 'title_en', 'description_ar', 'description_en', 'image','image_ar','mobile_image','mobile_image_ar'])->get();
        $collections = Category::select(['id', 'name_ar', 'name_en', 'slug', 'image'])->get();
        $products = Product::select(['id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'slug', 'image', 'price', 'discount_price', 'review'])
            ->with('photos')
            ->get();
        $firstCategory = FeaturedCategory::select(['id', 'title_ar', 'title_en', 'link', 'image'])->find(1);
        $secondCategory = FeaturedCategory::select(['id', 'title_ar', 'title_en', 'link', 'image'])->find(2);
        $thirdCategory = FeaturedCategory::select(['id', 'title_ar', 'title_en', 'link', 'image'])->find(3);
        $fourthCategory = FeaturedCategory::select(['id', 'title_ar', 'title_en', 'link', 'image'])->find(4);
        $fifthCategory = FeaturedCategory::select(['id', 'title_ar', 'title_en', 'link', 'image'])->find(5);
        $sixCategory = FeaturedCategory::select(['id', 'title_ar', 'title_en', 'link', 'image'])->find(6);
        $blogs = Blog::all();
        $reels = Reel::all();
        return view('front.index', compact('sliders', 'collections', 'products', 'firstCategory',
            'secondCategory', 'thirdCategory', 'fourthCategory', 'fifthCategory', 'sixCategory', 'blogs','reels'));
    }

    public function newsletter(NewsletterRequest $request)
    {

        $data = $request->validated();
        $email = NewsLetter::where('email', $request->email)->first();
        if ($email) {
            session()->flash('news_error',__('You already subscribed'));
            return redirect()->back();
        }
        NewsLetter::create($data);
        session()->flash('news_success', __('Newsletter has been sent successfully'));
        return redirect()->back();
    }
}
