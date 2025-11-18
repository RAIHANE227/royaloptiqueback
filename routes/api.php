<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/produits', [ProductController::class, 'index']);
Route::get('/produits/{product}', [ProductController::class, 'show']);

Route::middleware('user_only')->group(function () {
    Route::get('/panier', [CartController::class, 'summary']);
    Route::post('/panier', [CartController::class, 'add']);
    Route::patch('/panier/{product}', [CartController::class, 'update']);
    Route::delete('/panier/{product}', [CartController::class, 'remove']);
    Route::delete('/panier', [CartController::class, 'clear']);

    Route::post('/commandes', [OrderController::class, 'store']);
    Route::get('/commandes', [OrderController::class, 'myOrders']);
    Route::get('/commandes/{order}', [OrderController::class, 'show']);
});

Route::get('/livraison', [DeliveryController::class, 'showFee']);
