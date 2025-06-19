<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// with rate limit
// max  10 requests per minute
Route::middleware('ThrottleRequests')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
});

//or the same thing with throttle 
// Route::middleware('throttle:10,1')->group(function () {
// Route::get('/products', [ProductController::class, 'index']);
// });

// without rate limit
Route::get('/products2', [ProductController::class, 'index']);

Route::get('/products/export', [ProductController::class, 'export']);
