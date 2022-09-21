<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\ListingController;
use App\Http\Controllers\Dashboard\ViolationsController;
use App\Http\Controllers\Dashboard\ParentCategoriesController;
use App\Http\Controllers\Dashboard\ChildCategoriesController;
use App\Http\Controllers\Dashboard\FiltersController;
use App\Http\Controllers\Dashboard\PaymentsController;
use App\Http\Controllers\Dashboard\PhoneNumbersController;

Route::prefix('dashboard')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', UsersController::class);
    Route::resource('listings', ListingController::class);
    Route::resource('violations', ViolationsController::class);
    Route::resource('parentCategories', ParentCategoriesController::class);
    Route::resource('childCategories', ChildCategoriesController::class);

    Route::get('/filter/get-type', [FiltersController::class, 'getType'])->name('filters.getType');
    Route::resource('filters', FiltersController::class);

    Route::post('/payment/change-status', [PaymentsController::class, 'changeStatus'])->name('payment.change');
    Route::get('/payment/pdf', [PaymentsController::class, 'downloadPDF']);

    Route::resource('payments', PaymentsController::class);

    Route::resource('phone-numbers', PhoneNumbersController::class);

});
