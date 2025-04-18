<?php

use App\Http\Controllers\Admin\AppSettingController;
use App\Http\Controllers\Admin\BannerSliderController;
use App\Http\Controllers\Admin\NewsSliderController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\WithdrawController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommissionConotroller;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\TaskController;
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

    Route::prefix('withdraw')
        ->controller(PaymentController::class)
        ->name('withdraw.')
        ->group(function () {
            Route::get('/', 'withdrawIndex')->name('index');
            Route::post('/store', 'withdrawStore')->name('store');
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
            Route::get('/company', 'companyInfo')->name('company.info');
        });

    Route::prefix('transaction')
        ->controller(TransactionController::class)
        ->name('user_transaction.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
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

    Route::prefix('admin/withdraws')
        ->controller(WithdrawController::class)
        ->name('withdraw.')
        ->middleware(['admin'])
        ->group(function () {
            Route::get('/', 'index')->name('requests');
            Route::get('/details/{id}', 'details')->name('details');
            Route::get('/approve/{id}', 'approve')->name('approve');
            Route::get('/reject/{id}', 'reject')->name('reject');
        });

    Route::prefix('admin/users')
        ->controller(UserController::class)
        ->name('user.')
        ->middleware(['admin'])
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/details/{id}', 'details')->name('details');
        });

    Route::prefix('admin/commissions')
        ->controller(CommissionConotroller::class)
        ->name('commission.')
        ->middleware(['admin'])
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/distribute/form/{user_id}', 'commissionForm')->name('form');
            Route::post('/store', 'store')->name('store');
        });

    Route::prefix('tasks')
        ->controller(TaskController::class)
        ->name('tasks.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/complete/{id}', 'grabTask')->name('grab');
        });
});
