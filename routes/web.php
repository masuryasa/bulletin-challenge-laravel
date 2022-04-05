<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('', [MessageController::class, 'index'])->name('index');

Route::prefix('message')->group(function () {
    Route::post('store', [MessageController::class, 'store'])->name('store');
    Route::post('get', [MessageController::class, 'getDetail'])->name('detail');
    Route::post('update', [MessageController::class, 'update'])->name('update');
    Route::post('delete', [MessageController::class, 'delete'])->name('delete');
});

Route::post('password-validation', [MessageController::class, 'passwordValidation']);

Route::prefix('register')->group(function () {
    Route::get('', [UserController::class, 'index'])->name('register-form');
    Route::post('confirm', [UserController::class, 'confirm'])->name('confirm');
    Route::post('', [UserController::class, 'register'])->name('register');
});

// Auth::routes();
// Auth::routes(['verify' => true]);

Route::get('login', [UserController::class, 'login']);
Route::post('login', [UserController::class, 'authenticate'])->middleware(['auth', 'verified']);

Route::post('logout', [UserController::class, 'logout'])->middleware(['auth', 'verified']);
