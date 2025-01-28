<?php

use App\Events\UpdatedAnalyticsEvent;
use App\Http\Controllers\AIController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\WeatherController;

Route::prefix('orders')->group(function() {
    Route::get('/', [OrderController::class, 'index']);
    Route::post('add', [OrderController::class, 'store']);
    Route::get('details/{id}', [OrderController::class, 'show']);
    Route::put('upd/{id}', [OrderController::class, 'update']);
    Route::delete('del/{id}', [OrderController::class, 'destroy']);
});

// Products routes
Route::prefix('products')->group(function() {
    Route::get('/', [ProductsController::class, 'index']);
    Route::post('add', [ProductsController::class, 'store']);
    // Route::get('details/{id}', [ProductsController::class, 'show']);
    Route::delete('delete/{id}', [ProductsController::class, 'delete']);
});

Route::get('weather/recommendations', [WeatherController::class, 'recommendations']);
// Analytics routes
Route::get('/analytics', [AnalyticsController::class, 'index']);

Route::get('ai/recommendations', [AIController::class, 'getRecommendations']);
