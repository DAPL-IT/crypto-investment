<?php

use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\BannerSliderController;
use App\Http\Controllers\Admin\NewsSliderController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;


//Config cache clear
Route::get('clear', [AppSettingController::class, 'optimize'])->name('clear');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::prefix('deposit')
        ->controller(PaymentController::class)
        ->name('deposit.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
        });

    Route::prefix('dashboard')
        ->controller(DashBoardController::class)
        ->group(function () {
            Route::get('/', 'index')->name('dashboard');
        });
    Route::prefix('banner-slider')
        ->controller(BannerSliderController::class)
        ->name('banner_slider.')
        ->middleware(['admin'])
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('create');
            Route::delete('/{id}', 'destroy')->name('delete');
        });

    Route::prefix('news-slider')
        ->controller(NewsSliderController::class)
        ->name('news_slider.')
        ->middleware(['admin'])
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('create');
            Route::delete('/{id}', 'destroy')->name('delete');
        });

    Route::prefix('app-settings')
        ->controller(AppSettingController::class)
        ->name('app_settings.')
        ->middleware(['admin'])
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/{id}', 'update')->name('update');
            route::get('/optimize', 'optimize')->name('optimize');
        });

    Route::prefix('profile')
        ->controller(UserProfileController::class)
        ->name('user_profile.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/general', 'generalEdit')->name('general.edit');
            Route::put('/general', 'generalUpdate')->name('general.update');
            Route::get('/password', 'passwordEdit')->name('password.edit');
            Route::put('/password', 'passwordUpdate')->name('password.update');
            Route::get('/image', 'imageEdit')->name('image.edit');
            Route::post('/image', 'imageUpdate')->name('image.update');
            Route::get('/image-remove', 'imageDelete')->name('image.delete');
            Route::get('/details', 'detailsEdit')->name('details.edit');
            Route::put('/details', 'detailsUpdate')->name('details.update');
        });

    Route::prefix('admin/deposits')
        ->controller(DepositController::class)
        ->name('deposit.')
        ->middleware(['admin'])
        ->group(function () {
            Route::get('/', 'index')->name('requests');
            Route::get('/details/{id}', 'details')->name('details');
            Route::get('/approve/{id}', 'approve')->name('approve');
            Route::get('/reject/{id}', 'reject')->name('reject');
        });
});
