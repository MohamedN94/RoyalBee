<?php

use App\Http\Controllers\Dashboard\AuthenticationController;
use App\Http\Controllers\Dashboard\ContactController as DashboardContactController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\InformationController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ReelController;
use App\Http\Controllers\Dashboard\SeoController;
use App\Http\Controllers\Dashboard\ServiceController as DashboardServiceController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\StateController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/admin', 'as' => 'dashboard.'], function () {

    Route::get('/login', [AuthenticationController::class, 'index'])->name('auth.index');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('auth.login');

    Route::get('/', [AuthenticationController::class, 'show'])->name('index');

    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('auth.logout');

//    //slider
//    Route::resource('sliders', SliderController::class)->except('show');
//    Route::get('sliders/show',[SliderController::class , 'show'])->name('sliders.show');

    //User Routes
    Route::resource('users', UserController::class)->except('show');
    Route::get('users/show', [UserController::class, 'show'])->name('users.show');

    //Role Routes
    Route::resource('roles', 'RoleController')->except('show');
    Route::get('roles/show', 'RoleController@show')->name('roles.show');

    //Role Category
    Route::resource('Categories', 'CategoryController')->except('show');
    Route::get('Categories/show', 'CategoryController@show')->name('category.show');

    //Role Category
    Route::resource('Blogs', 'BlogController')->except('show');
    Route::get('Blogs/show', 'BlogController@show')->name('blog.show');

    // Coupons
    Route::resource('/coupons', 'CouponController')->except('show');
    Route::get('coupons/show', 'CouponController@show')->name('coupons.show');

    // Featured Categories
    Route::resource('/featured_categories', 'FeaturedCategoryController')->except('show');
    Route::get('featured_categories/show', 'FeaturedCategoryController@show')->name('featuredCategories.show');

    // products
    Route::resource('/products', 'ProductController')->except('show');
    Route::get('products/show', 'ProductController@show')->name('products.show');
    Route::post('/admin/upload-products', [ProductController::class, 'uploadProducts'])->name('upload.products');
    Route::post('/products/{id}/toggle-trending', [ProductController::class, 'toggleTrendingProduct'])->name('products.toggleTrending');
    Route::post('/products/{id}/toggle-best-seller', [ProductController::class, 'toggleBestSeller'])->name('products.toggleBestSeller');
    Route::post('/products/{id}/visible', [ProductController::class, 'visible'])->name('products.visible');

    // pages
    Route::get('pages/show', 'PageController@show')->name('pages.show');
    Route::resource('pages', 'PageController')->except('show');

    // Payments
    Route::get('payments/show', 'PaymentController@show')->name('payments.show');
    Route::get('payments/details/{payment}', 'PaymentController@details')->name('payments.details');
    Route::resource('payments', 'PaymentController')->except('show');

    // sliders
    Route::get('sliders/show', 'SliderController@show')->name('sliders.show');
    Route::resource('sliders', 'SliderController')->except('show');

    //photo
    Route::resource('photo', 'PhotoController');

    //Role Service
    Route::resource('Services', DashboardServiceController::class)->except('show');
    Route::get('Services/show', [DashboardServiceController::class, 'show'])->name('service.show');

    //Role Information
    Route::resource('Information', InformationController::class)->except('show');
    Route::get('Information/show', [InformationController::class, 'show'])->name('information.show');

    //Settings routes
    Route::get('/settings', [SettingController::class, 'setting'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'settingUpdate'])->name('settings.update');

    //Role SEO
    Route::resource('SEO', SeoController::class)->except('show');
    Route::get('SEO/show', [SeoController::class, 'show'])->name('seo.show');

    //Role Contact
    Route::resource('Contact', DashboardContactController::class)->except('show');
    Route::get('Contact/show', [DashboardContactController::class, 'show'])->name('contact.show');
    Route::get('Contact/Message/{id}', [DashboardContactController::class, 'showAll'])->name('contact.message');
    
    //Instegram Reels
    Route::resource('Reels', 'ReelController')->except('show');
    Route::get('Reels/show', [ReelController::class, 'show'])->name('reel.show');
    //countries
    Route::resource('countries', 'CountryController')->except('show');
    Route::get('countries/show', [CountryController::class, 'show'])->name('countries.show');
    //State
    Route::resource('states', 'StateController')->except('show');
    Route::get('states/show', [StateController::class, 'show'])->name('states.show');

    // artisan Command
    Route::get('/clear-config-cache', function () {
        $exitCode = Artisan::call('config:cache');
        return 'Config cache has just been removed';
    });
    // Remove application cache
    Route::get('/clear-app-cache', function () {
        $configCache = Artisan::call('config:cache');
        $clearCache = Artisan::call('cache:clear');
        return 'Application cache has just been removed';
    });
    Route::get('/linkstorage', function () {
        Artisan::call('storage:link');
    });
});

