<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::prefix('bukus')->name('bukus.')->group(function () {
    Route::get('/', [BukuController::class, 'index'])->name('index');
    Route::get('/create', [BukuController::class, 'create'])->name('create');
    Route::post('/', [BukuController::class, 'store'])->name('store');
    Route::get('/{buku}/edit', [BukuController::class, 'edit'])->name('edit');
    Route::put('/{buku}', [BukuController::class, 'update'])->name('update');
    Route::delete('/{buku}', [BukuController::class, 'destroy'])->name('destroy');
});

Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('index');
    Route::get('/create', [CategoriesController::class, 'create'])->name('create');
    Route::post('/', [CategoriesController::class, 'store'])->name('store');
    Route::get('/{category}/edit', [CategoriesController::class, 'edit'])->name('edit');
    Route::put('/{category}', [CategoriesController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoriesController::class, 'destroy'])->name('destroy');
});
