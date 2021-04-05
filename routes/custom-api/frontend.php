<?php

use App\Http\Controllers\Api\BlogController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/frontend/blogs'], function () {
    Route::get('/', [BlogController::class, 'index']);
});