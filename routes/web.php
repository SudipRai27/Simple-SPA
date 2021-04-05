<?php

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/test', function () {
    $blog = Blog::find(6);
    $mediaItems = $blog->getMedia('image');

    // $publicUrl = $mediaItems[0]->getUrl();
    dd($mediaItems[0]->getUrl());
    // return view('test');
});

Route::post('test.post', function () {
    dd(request()->all());
})->name('test.post');

Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');