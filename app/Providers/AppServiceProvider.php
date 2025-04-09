<?php

namespace App\Providers;

use App\Models\Admin\Category;
use App\Models\Site\Information;
use App\Models\Site\Service;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::defaultView('vendor.pagination.default');

        Paginator::defaultSimpleView('vendor.pagination.default');

        View::composer('front.layouts.app', function ($view) {
            $collections = Category::select(['id', 'name_ar', 'name_en', 'slug', 'image'])->get();
            $view->with('collections', $collections);
        });
        view()->share('info_data',
            Information::first());
        view()->share('Service_footer',
        Service::take(7)->get());

    }
}
