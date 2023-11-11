<?php

use App\Http\Controllers\Admin\BannerSliderController;
use App\Http\Controllers\Admin\NewsSliderController;
use App\Http\Controllers\ProfileController;
use App\Models\BannerSlider;
use Illuminate\Support\Facades\Route;


//Config cache clear
Route::get('clear', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    \Artisan::call('view:clear');
    \Artisan::call('optimize');
    echo "All clear!";
});

require __DIR__ . '/auth.php';

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::prefix('banner-slider')
        ->controller(BannerSliderController::class)
        ->name('banner_slider.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('create');
            Route::delete('/{id}', 'destroy')->name('delete');
        });

    Route::prefix('news-slider')
        ->controller(NewsSliderController::class)
        ->name('news_slider.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('create');
            Route::delete('/{id}', 'destroy')->name('delete');
        });
});
