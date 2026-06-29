<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;

// =============================================================
// AUTH & LOGIN
// =============================================================
// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.submit');
    Route::post('/logout', 'logout')->name('logout');

    // Password Reset
    Route::get('/forgot-password', 'showForgotPasswordForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLinkEmail')->name('password.email');
    Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
    Route::post('/reset-password', 'reset')->name('password.update');
});

// Registration
Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register')->name('register.submit');
});



// =============================================================
// PUBLIC PAGES
// =============================================================
Route::get('/', [PageController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/customisation', [PageController::class, 'customisation']);
Route::get('/customer-service', [PageController::class, 'customerservice']);
// CONTACT PAGE LOAD
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// CONTACT FORM SUBMIT
Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');
Route::get('/search', [SearchController::class, 'index'])
    ->name('search');



// =============================================================
// COLLECTION PAGES
// =============================================================
Route::prefix('collection')->group(function () {
    Route::get('{slug}', [ProductController::class, 'category'])
        ->name('collection.category');
});
Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('product.show');



// =============================================================
//  CART ROUTES 
// =============================================================
Route::middleware('auth')->group(function () {
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'show'])->name('index');
        Route::post('/add', [CartController::class, 'add'])->name('add');
        Route::get('/remove/{id}', [CartController::class, 'remove'])->name('remove');
        Route::get('/clear', [CartController::class, 'clear'])->name('clear');
        Route::get('/qty/{id}/{action}', [CartController::class, 'updateQuantity'])->name('qty');
    });
});

// User bina login ho to Add to Cart pe login page dikhe
Route::post('/add-to-cart', function () {
    return redirect()->route('login')->with('error', 'Please login to add items to cart.');
})->name('cart.guest');


// =============================================================
// CHECKOUT
// =============================================================
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/confirmation/{order}', [App\Http\Controllers\CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
});


// =============================================================
// USER LOGGED IN PANEL
// =============================================================
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    // Profile
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile');
    Route::post('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.password');


    // Orders
    Route::get('/orders', [UserProfileController::class, 'orders'])->name('orders');
    Route::get('/order-details', [UserProfileController::class, 'orderDetails'])->name('order-details');
    Route::get('/user/order-details/{order}', [OrderController::class, 'show'])->name('user.order-details');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Product categories

});

// =============================================================
// ADMIN PANEL
// =============================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', App\Http\Controllers\Admin\AdminProductController::class)->except(['show']);

    // Categories
    Route::resource('categories', App\Http\Controllers\Admin\AdminCategoryController::class)->except(['show']);

    // Orders
    Route::get('/orders', [App\Http\Controllers\Admin\AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\Admin\AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [App\Http\Controllers\Admin\AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::delete('/orders/{order}', [App\Http\Controllers\Admin\AdminOrderController::class, 'destroy'])->name('orders.destroy');

    // Users
    Route::get('/users', [App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('users.destroy');

    // Banners
    Route::resource('banners', App\Http\Controllers\Admin\AdminBannerController::class)->except(['show']);

    // Sliders
    Route::resource('sliders', App\Http\Controllers\Admin\AdminSliderController::class)->except(['show']);

    // Page Contents
    Route::resource('page-contents', App\Http\Controllers\Admin\AdminPageContentController::class)->except(['show']);

    // Carousels
    Route::resource('carousels', App\Http\Controllers\Admin\AdminCarouselController::class)->except(['show']);

    // Contacts
    Route::get('/contacts', [App\Http\Controllers\Admin\AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [App\Http\Controllers\Admin\AdminContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [App\Http\Controllers\Admin\AdminContactController::class, 'destroy'])->name('contacts.destroy');
});
