<?php

use App\Http\Controllers\MessageController;
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

Route::get('/', [MessageController::class, 'index']);

Route::post('/insert-message', [MessageController::class, 'insert']);

Route::post('/edit-message', [MessageController::class, 'edit']);

Route::post('/message/get-message', [MessageController::class, 'getDetail']);

Route::post('/delete-message', [MessageController::class, 'delete']);

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::prefix('register')->group(function () {
    Route::get('/success', function () {
        return view('register-success');
    });
    Route::get('/success/2', function () {
        return view('register-success-2');
    });
});

Route::get('test', [MessageController::class, 'index']);
