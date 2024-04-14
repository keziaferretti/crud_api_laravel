<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('status', StatusController::class);

Route::apiResource('products', ProductController::class);