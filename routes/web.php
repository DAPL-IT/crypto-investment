<?php

use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\BannerSliderController;
use App\Http\Controllers\Admin\NewsSliderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;


//Config cache clear
Route::get('clear', [AppSettingController::class, 'optimize'])->name('clear');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Deposit...
    Route::get('/deposit', [PaymentController::class, 'index'])->name('deposit.index');
});

Route::middleware('auth')->group(function () {
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
        });
});
