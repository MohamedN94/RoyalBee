<?php

use App\Http\Controllers\Dashboard\AuthenticationController;

use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Site\CollectionController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomePageController;
use App\Http\Controllers\Site\PageController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\SearchController;
use App\Http\Controllers\Site\WishlistController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

//site
Route::namespace('Site')->group(function () {
    Route::group(['as' => 'web.'], function () {
        Route::get('/', [HomePageController::class, 'index'])->name('home');
        Route::get('/about-us', [AboutController::class, 'index'])->name('about');
        Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
        Route::post('/Contact/Submit', [ContactController::class, 'submit'])->name('submit');
        Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
        Route::get('/collections/{slug}', [CollectionController::class, 'show'])->name('collections.show');
        Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');
        Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
        Route::get('/get-products-by-collection', [ProductController::class, 'getProductsByCollection']);
        Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
        Route::get('/signup', [AuthController::class, 'signUpForm'])->name('signup.form');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
        Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/products', [SearchController::class, 'search'])->name('search');
        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
        Route::post('/newsletter', [HomePageController::class, 'newsletter'])->name('newsletter');

        Route::group(['middleware' => ['store.intended.url']], function () {
            Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        });
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/place-order/{product}', [CheckoutController::class, 'placeOrder'])->name('place.order');
        Route::post('/checkout/process', [CheckoutController::class, 'checkoutProcess'])->name('checkout.process');
        Route::get('/checkout/success/{transactionId}', [CheckoutController::class, 'checkoutSuccess'])->name('checkout.success');
        // Route::get('/checkout/callback', [CheckoutController::class, 'checkoutCallback'])->name('checkout.callback');
        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::get('/blog/{blog}', [BlogController::class, 'blogDetail'])->name('blogDetail');
    });
});

//Route::get('/home', [AuthenticationController::class, 'index'])->name('auth.index');
Route::post('/reviews/store', [ProductController::class, 'review'])->name('reviews.store');
Route::get('/states-by-country', [ProductController::class, 'getStatesByCountry']);

Route::get('test', function () {
    Artisan::call('optimize:clear');
    Artisan::call('view:cache');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return 'done';
});
Route::get('/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
});

// Local switchlanguage-
Route::get('/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});
