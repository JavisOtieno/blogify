<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

use App\Http\Controllers\Admin\PostController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', PostController::class);
    Route::post('posts/import', [PostController::class, 'import'])->name('posts.import');
});
Route::get('/', function () {
    return view('home');
})->name('home');
Route::resource('posts', PostController::class)->only(['index','show']);

