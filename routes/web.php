<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua rute dengan middleware 'auth'
Route::middleware('auth')->group(function () {

    // Rute untuk role writer
    Route::middleware('CheckRole:writer')->group(function () {
        Route::resource('articles', ArticleController::class)->only(['create', 'store', 'index']);
    });

    // Rute untuk role admin
    Route::middleware('CheckRole:admin')->group(function () {
        Route::resource('articles', ArticleController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('tags', TagController::class);
    });

    // Rute untuk pengaturan profil (untuk semua role)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute otentikasi
require __DIR__ . '/auth.php';
