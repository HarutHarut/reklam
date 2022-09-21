<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\SearchController;
use App\Http\Controllers\Client\CategoryController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Client\OglasiController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\PayPalController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pogosta-vprasanja', [HomeController::class, 'faq'])->name('faq');
Route::get('/emailVerify', [RegisterController::class, 'emailVerify'])->name('emailVerify');
Route::post('/check-tax-number/{tax_number}', [RegisterController::class, 'checkTaxNumber'])->name('check.taxNumber');
Route::get('/forgot', [ForgotPasswordController::class, 'forgot'])->name('forgot.password');
Route::post('/forgot/update', [ForgotPasswordController::class, 'forgotUpdate'])->name('forgot.update');
Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::get('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');
Route::get('listing/{listing_id}', [CategoryController::class, 'listingSingleURL'])->name('listing.single.url');

Auth::routes();

Route::prefix('oauth')->group(function () {
    Route::get('/{driver}', [LoginController::class, 'redirectToProvider'])->name('social.oauth');
    Route::get('/{driver}/callback', [LoginController::class, 'handleProviderCallback'])->name('social.callback');
});

Route::prefix('search')->group(function () {
    Route::get('/', [SearchController::class, 'index'])->name('search');
    Route::get('/products', [SearchController::class, 'searchProducts'])->name('search.products');
    Route::get('/categories', [SearchController::class, 'searchCategories'])->name('search.categories');
});

Route::prefix('category')->group(function () {
    Route::get('/{slug}', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/{slug}/{listingSlug}', [CategoryController::class, 'listingSingle'])->name('category.listing');
});
Route::get('/all-products', [CategoryController::class, 'allProducts'])->name('all-products');

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/filter', [ProfileController::class, 'filter'])->name('profile.filter');
        Route::post('/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/edit-password/{id}', [ProfileController::class, 'editPassword'])->name('profile.edit');
        Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
        Route::post('/upgrade', [ProfileController::class, 'upgrade'])->name('profile.upgrade');
        Route::get('/packages', [ProfileController::class, 'index'])->name('profile.upgrade');
        Route::post('/prolong', [ProfileController::class, 'prolong'])->name('profile.prolong');
        Route::post('/delete-listing/{id}', [ProfileController::class, 'destroy'])->name('delete.listing');
        Route::post('/delete-many-listing', [ProfileController::class, 'destroyMany'])->name('delete.manyListing');
        Route::post('/listing/change-status/{id}', [ProfileController::class, 'changeStatus'])->name('change.status');
        Route::post('/listing/prologon-30/{id}', [ProfileController::class, 'prologon30'])->name('prologon30');
        Route::post('/listing/prologon-7/{id}', [ProfileController::class, 'prologon7'])->name('prologon7');
        Route::get('/edit-listing/{id}', [ProfileController::class, 'editListing'])->name('edit.listing');
        Route::post('/listing/update', [ProfileController::class, 'listingUpdate'])->name('update.listing');
    });
});

Route::prefix('nov-oglas')->group(function () {
    Route::get('/', [OglasiController::class, 'novOglas'])->name('nov-oglas');
    Route::post('/check-category', [OglasiController::class, 'checkCategory'])->name('check-category');
    Route::post('/check-region', [OglasiController::class, 'checkRegion'])->name('check-region');
    Route::post('/store', [OglasiController::class, 'store'])->name('store');

});
Route::prefix('company')->group(function () {
    Route::get('/category/{category_slug?}', [CompanyController::class, 'index'])->name('company.index');
    Route::get('/customers/{company_slug}', [CompanyController::class, 'single'])->name('company.single');
});

Route::post('/favorite', [ProfileController::class, 'favorite'])->name('profile.favorite');
Route::get('/favorite-auth', [ProfileController::class, 'favoriteNoAuth'])->name('favorite.auth');
Route::get('/product/{slug}', [ProductController::class, 'index'])->name('product.index');
Route::post('/send-message', [ProductController::class, 'sendMessage'])->name('send.message');
Route::post('/send-report', [ProductController::class, 'sendReport'])->name('send.report');

Route::fallback([CategoryController::class, 'apiCategory']);


// PayPal //
Route::get('payment', [PayPalController::class, 'payment'])->name('payment');
Route::get('cancel', [PayPalController::class, 'cancel'])->name('payment.cancel');
Route::get('payment/success/{listing_id}', [PayPalController::class, 'success'])->name('payment.success');


Route::get('test', function (){

  return view('test');
});

