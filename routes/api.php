<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MenuLevelController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SettingMenuUserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route::post('/DataJenis_User', [UsersController::class, 'store']);
// Route::put('/DataJenis_User/{id}', [UsersController::class, 'update']);
// Route::delete('/DataJenis_User/{id}', [UsersController::class, 'destroy']);

Route::get('/jenis_users', [UsersController::class, 'Get_Data_JU']);
Route::get('/users', [UserController::class, 'Get_Data_User']);
Route::get('/bukus', [BukuController::class, 'Get_Data_Buku']);
Route::get('/categories', [CategoriesController::class, 'Get_Data_Category']);
Route::get('/menus', [MenuController::class, 'Get_Data_Menus'])->middleware('auth:sanctum');
// web.php
Route::get('/posts', [PostController::class, 'getPosts'])->name('posts.list');

// Route::post('/menu-levels', [MenuLevelController::class, 'Get_Data_Level'])->middleware('auth:sanctum');
// Route::post('/setting-menu-users', [SettingMenuUserController::class, 'Get_Data_Setting'])->middleware('auth:sanctum');
// Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
// Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth:sanctum')->where('id', '[0-9]+');



