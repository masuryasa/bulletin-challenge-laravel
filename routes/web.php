<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
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

Route::get('', [MessageController::class, 'index']);

Route::post('insert-message', [MessageController::class, 'insert']);

Route::post('edit-message', [MessageController::class, 'edit']);

Route::post('password-validation', [MessageController::class, 'passwordValidation']);

Route::post('message/get-message', [MessageController::class, 'getDetail']);

Route::post('delete-message', [MessageController::class, 'delete']);

Route::prefix('register')->group(function () {
    Route::get('', [UserController::class, 'index']);

    Route::post('confirm', [UserController::class, 'confirm']);

    Route::post('', [UserController::class, 'register']);
});

// Route::prefix('login')->group(function () {
Route::get('login', [UserController::class, 'login']);
Route::post('login', [UserController::class, 'authenticate']);
// });

Route::post('logout', [UserController::class, 'logout']);
