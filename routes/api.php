<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'apiIndex']);

Route::post('/products', [ProductController::class, 'apiStore']);

Route::get('/products/{id}', [ProductController::class, 'apiShow']);

Route::put('/products/{id}', [ProductController::class, 'apiUpdate']);

Route::delete('/products/{id}', [ProductController::class, 'apiDelete']);