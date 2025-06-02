<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);

Route::get('products', [ProductController::class, 'index']);
Route::get('products/barcode/{barcode}', [ProductController::class, 'showByBarcode'])->middleware(['auth:sanctum']);
