<?php

use App\Http\Controllers\Api\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'blogs'], function () {
    Route::get('/', [BlogController::class, 'index']);
    Route::get('/edit/{id}', [BlogController::class, 'edit']);

    Route::post('/create', [BlogController::class, 'store']);
    Route::put('/update/{id}', [BlogController::class, 'update']);
    Route::delete('/delete/{id}', [BlogController::class, 'delete']);
});