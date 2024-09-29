<?php

use App\Http\Middleware\isUser;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BmkgController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuLevelController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SettingMenuUserController;

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

Route::prefix('menus')->middleware(['auth', isAdmin::class])->name('menus.')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('index');
    Route::get('/create', [MenuController::class, 'create'])->name('create');
    Route::post('/', [MenuController::class, 'store'])->name('store');
    Route::get('/{menu}/edit', [MenuController::class, 'edit'])->name('edit');
    Route::put('/{menu}', [MenuController::class, 'update'])->name('update');
    Route::delete('/{menu}', [MenuController::class, 'destroy'])->name('destroy');
});

Route::prefix('menu-levels')->middleware(['auth', isAdmin::class])->name('menu-levels.')->group(function () {
    Route::get('/', [MenuLevelController::class, 'index'])->name('index');
    Route::get('/create', [MenuLevelController::class, 'create'])->name('create');
    Route::post('/', [MenuLevelController::class, 'store'])->name('store');
    Route::get('/{menuLevel}/edit', [MenuLevelController::class, 'edit'])->name('edit');
    Route::put('/{menuLevel}', [MenuLevelController::class, 'update'])->name('update');
    Route::delete('/{menuLevel}', [MenuLevelController::class, 'destroy'])->name('destroy');
});

Route::prefix('jenis-user')->middleware(['auth', isAdmin::class])->name('jenis-user.')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('index');
    Route::get('/create', [UsersController::class, 'create'])->name('create');
    Route::post('/', [UsersController::class, 'store'])->name('store');
    Route::get('/{jenisUser}/edit', [UsersController::class, 'edit'])->name('edit');
    Route::put('/{jenisUser}', [UsersController::class, 'update'])->name('update');
    Route::delete('/{jenisUser}', [UsersController::class, 'destroy'])->name('destroy');
});

Route::prefix('users')->middleware(['auth', isAdmin::class])->name('users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
});

Route::prefix('settingmenuuser')->middleware(['auth', isAdmin::class])->name('settingmenuuser.')->group(function () {
    Route::get('/', [SettingMenuUserController::class, 'index'])->name('index');
    Route::get('/create', [SettingMenuUserController::class, 'create'])->name('create');
    Route::post('/', [SettingMenuUserController::class, 'store'])->name('store');
    Route::get('/{settingMenuUser}/edit', [SettingMenuUserController::class, 'edit'])->name('edit');
    Route::put('/{settingMenuUser}', [SettingMenuUserController::class, 'update'])->name('update');
    Route::delete('/{settingMenuUser}', [SettingMenuUserController::class, 'destroy'])->name('destroy');
});

Route::prefix('post')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/', [PostController::class, 'store'])->name('post.store');
    Route::get('/{post}', [PostController::class, 'show'])->name('post.show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});

Route::post('/post/{post_id}/like', [PostController::class, 'like'])->name('post.like');
Route::post('/post/{post_id}/comment', [PostController::class, 'comment'])->name('comments.store');



Route::get('/gempa', [BmkgController::class, 'gempa']);

Route::get('/cuaca', function () {
    return view('bmkg.cuaca');
})->name('cuaca')->middleware('auth');

Route::get('/login', [AuthController::class, 'indexlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'actionlogout'])->name('logout');
Route::get('/register', [AuthController::class, 'indexregister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
