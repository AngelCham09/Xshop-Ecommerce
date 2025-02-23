<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProductListController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\RedirectAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [ UserController::class, 'index'])->name('home');
Route::get('/about', [ UserController::class, 'about'])->name('about');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/privacy', [UserController::class, 'privacy'])->name('privacy');
Route::get('/terms', [UserController::class, 'terms'])->name('terms');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //checkout
    Route::prefix('checkout')->controller(CheckoutController::class)->group(function () {
        Route::get('/', 'view')->name('checkout.view');
        Route::post('order', 'store')->name('checkout.store');
        Route::get('success', 'success')->name('checkout.success');
        Route::get('cancel', 'cancel')->name('checkout.cancel');
    });
});

//add to cart
Route::prefix('cart')->controller(CartController::class)->group(function () {
    Route::get('view', 'view')->name('cart.view');
    Route::post('store/{product}', 'store')->name('cart.store');
    Route::patch('update/{product}', 'update')->name(
    'cart.update');
    Route::delete('delete/{product}', 'delete')->name('cart.delete');
});

///routes for product list and filter
Route::prefix('products')->controller(ProductListController::class)->group(function () {
    Route::get('/', 'index')->name('products.index');
    // Route::get('/{product}', 'show')->name('products.show');
    // Route::get('/category/{category}', 'category')->name('products.category');
    // Route::get('/brand/{brand}', 'brand')->name('products.brand');
});

//admin route
Route::group(['prefix' => 'admin', 'middleware' => RedirectAdmin::class], function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name(
        'admin.login'
    );
    Route::post('login', [AdminAuthController::class, 'login'])->name(
        'admin.login.post'
    );
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

//Adminmiddlere is to verify if not admin then return error msg
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    //Product
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::post('products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/image/{id}', [ProductController::class, 'deleteImage'])->name('admin.products.image.delete');
    Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});


require __DIR__ . '/auth.php';
