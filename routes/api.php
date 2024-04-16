<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('status')->group(function () {
    Route::get('/', [StatusController::class, 'searchStatus']);
    Route::get('/{id}', [StatusController::class, 'searchIdStatus']);
    Route::post('/', [StatusController::class, 'createStatus']);
    Route::put('/{id}', [StatusController::class, 'updateStatus']);
    Route::delete('/{id}', [StatusController::class, 'deleteStatus']);
});

Route::apiResource('products', ProductController::class);