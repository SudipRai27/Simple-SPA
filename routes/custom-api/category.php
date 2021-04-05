<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'category'], function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/add', [CategoryController::class, 'store']);
    Route::get('/{id}', [CategoryController::class, 'edit']);
    Route::put('/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy']);
});