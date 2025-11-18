<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/selection', [ProductController::class, 'index'])->name('selection');
Route::get('/products/lunettes', [ProductController::class, 'byType'])->name('lunettes')->defaults('type', 'lunettes');
Route::get('/products/lentilles', [ProductController::class, 'byType'])->name('lentilles')->defaults('type', 'lentilles');
Route::get('/products/verres-medicaux', [ProductController::class, 'byType'])->name('verres-medicaux')->defaults('type', 'verres-medicaux');
Route::get('/products/accessoires', [ProductController::class, 'byType'])->name('accessoires')->defaults('type', 'accessoires');
Route::get('/produits/{product}', [ProductController::class, 'show'])->name('products.show');

Route::view('/faq', 'pages.faq')->name('faq');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/mentions-legales', 'pages.mentions-legales')->name('mentions');
Route::view('/politique-confidentialite', 'pages.politique-confidentialite')->name('privacy');

Route::middleware('guest_only')->group(function () {
    Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/connexion', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/inscription', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/inscription', [AuthController::class, 'register'])->name('register.submit');

    Route::get('/mot-de-passe-oublie', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/mot-de-passe-oublie', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reinitialisation/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reinitialisation', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::middleware('user_only')->group(function () {
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil/mot-de-passe', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
    Route::post('/panier', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/panier/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/panier/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/panier', [CartController::class, 'clear'])->name('cart.clear');

    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');
    Route::post('/commandes', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/mes-commandes', [OrderController::class, 'myOrders'])->name('orders.index');
    Route::get('/mes-commandes/{order}', [OrderController::class, 'show'])->name('orders.show');
});

Route::prefix('admin')->name('admin.')->middleware('admin_only')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    
    Route::resource('produits', ProductController::class)->parameters([
        'produits' => 'product'
    ]);
    Route::resource('categories', CategoryController::class)->parameters([
        'categories' => 'category'
    ]);
    Route::resource('commandes', OrderController::class)->only(['index', 'show', 'update', 'destroy'])->parameters([
        'commandes' => 'order'
    ]);
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle', [UserController::class, 'toggleStatus'])->name('users.toggle');
    
    Route::resource('livraison', DeliveryController::class)->parameters([
        'livraison' => 'deliveryFee',
    ]);

    Route::get('parametres', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('parametres', [SettingsController::class, 'update'])->name('settings.update');
});

Route::fallback(function () {
    return redirect()->route('home');
});
