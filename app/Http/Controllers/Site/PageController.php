<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormSubmitted;
use App\Models\Site\Seo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class PageController extends Controller
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
        $page = Page::where('slug', $slug)->select(['id', 'name_ar', 'description_ar', 'name_en', 'description_en'])->first();
        if (!$page) {
            abort(404);
        }
        return view('front.page', compact('page'));
    }

}
