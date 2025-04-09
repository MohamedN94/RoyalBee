<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Site\Seo;
use App\Models\Site\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Artesaos\SEOTools\Facades\SEOMeta;

class ServiceController extends Controller
{
    use SEOToolsTrait;

    function index() : View {
        $service= Seo::where('id',4)->first();
        $this->seo()->setTitle($service-> meta_title);
        $this->seo()->setDescription($service->meta_description);
        $this->seo()->opengraph()->setUrl($service->meta_canonical);
        $this->seo()->opengraph()->addProperty('type', $service->meta_property);
        $this->seo()->twitter()->setSite($service->meta_twitter);
        $this->seo()->jsonLd()->setType($service->meta_jsonLd);
        SEOMeta::addKeyword($service->meta_Keyword);

        return view('site.pages.Services.service')->withServices(Service::paginate(6));
    }

    function show(Service $service) : View {

        $this->seo()->setTitle($service-> meta_title);
        $this->seo()->setDescription($service->meta_description);
        $this->seo()->opengraph()->setUrl($service->meta_canonical);
        $this->seo()->opengraph()->addProperty('type', $service->meta_property);
        $this->seo()->twitter()->setSite($service->meta_twitter);
        $this->seo()->jsonLd()->setType($service->meta_jsonLd);
        SEOMeta::addKeyword($service->meta_Keyword);

        return view('site.pages.Services.single')
        ->withService($service)
        ->withServices(Service::take(6)->get());
    }
}
