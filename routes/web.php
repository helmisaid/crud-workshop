<?php

use App\Http\Middleware\isUser;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;

Route::get('/home', function () {
    return view('welcome');
})->name('home')->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::prefix('bukus')->middleware(['auth', isAdmin::class])->name('bukus.')->group(function () {
    Route::get('/', [BukuController::class, 'index'])->name('index');
    Route::get('/create', [BukuController::class, 'create'])->name('create');
    Route::post('/', [BukuController::class, 'store'])->name('store');
    Route::get('/{buku}/edit', [BukuController::class, 'edit'])->name('edit');
    Route::put('/{buku}', [BukuController::class, 'update'])->name('update');
    Route::delete('/{buku}', [BukuController::class, 'destroy'])->name('destroy');
});

Route::prefix('categories')->middleware(['auth', isAdmin::class])->name('categories.')->group(function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('index');
    Route::get('/create', [CategoriesController::class, 'create'])->name('create');
    Route::post('/', [CategoriesController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoriesController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoriesController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoriesController::class, 'destroy'])->name('destroy');
});

Route::get('/login', [AuthController::class, 'indexlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'actionlogout'])->name('logout');
Route::get('/register', [AuthController::class, 'indexregister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
