<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use App\Models\Site\Seo;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class AboutController extends Controller
{
    use SEOToolsTrait;

    function index(): View
    {
        $service = Seo::where('id', 3)->first();
        $this->seo()->setTitle($service->meta_title);
        $this->seo()->setDescription($service->meta_description);
        $this->seo()->opengraph()->setUrl($service->meta_canonical);
        $this->seo()->opengraph()->addProperty('type', $service->meta_property);
        $this->seo()->twitter()->setSite($service->meta_twitter);
        $this->seo()->jsonLd()->setType($service->meta_jsonLd);
        SEOMeta::addKeyword($service->meta_Keyword);
        $page = Page::where('page_type_id', 3)
            ->findOrFail(6);

        return view('front.about-us', compact('page'));
    }
}
