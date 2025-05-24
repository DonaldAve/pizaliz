<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{product}', [ProductController::class, 'update']);
Route::delete('/products/{product}', [ProductController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);


Route::get('/orders', [OrderController::class, 'index'])->middleware('auth:sanctum');
Route::get('/orders/{order}', [OrderController::class, 'show'])->middleware('auth:sanctum');

Route::get('/carts', [CartController::class, 'index'])->middleware('auth:sanctum');
Route::get('/carts/{cart}', [CartController::class, 'show'])->middleware('auth:sanctum');
Route::post('/carts', [CartController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/carts/{cart}', [CartController::class, 'destroy'])->middleware('auth:sanctum');
Route::put('/carts/{cart}', [CartController::class, 'update'])->middleware('auth:sanctum');

