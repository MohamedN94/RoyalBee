<?php

use App\Http\Controllers\Api\Clients\AuthController;
use App\Http\Controllers\Api\Clients\ProfileController;
use App\Http\Controllers\Api\Clients\SMSController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware("localization")->group(function () {

Route::namespace('Api')->group(function () {
    Route::namespace('Clients')->group(function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('login', [AuthController::class, 'login'])->name('login');

        });
        Route::post('send-group', [SMSController::class, 'smsGroup'])->name('sendSms.group');
        Route::post('send-sms', [SMSController::class, 'sendSms'])->name('sendSms');
        Route::post('profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('single-group', [SMSController::class, 'SingleGroup'])->name('single.sendSms');
        Route::post('sms-sent-successfully', [SMSController::class, 'SmsSentSuccessfully'])->name('success.sendSms');

        Route::post('slider', [SMSController::class, 'Slider'])->name('slider.sendSms');
        Route::post('complete-campaigns', [SMSController::class, 'CompleteCampaigns'])->name('CompleteCampaigns');

    });
});
});
Route::get('product/{id}', [ProductController::class, 'productDetails']);
