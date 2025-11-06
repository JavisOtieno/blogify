<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PostController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', PostController::class);
    Route::post('posts/import', [PostController::class, 'import'])->name('posts.import');
});
Route::get('/', function () {
    return view('home');
})->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
});
// Route::resource('posts', PostController::class)->only(['index','show']);

Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.post');

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
