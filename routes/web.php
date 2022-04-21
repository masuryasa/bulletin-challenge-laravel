<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

    Route::get('/email/verify', [UserController::class, 'registerNotification'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('index');
    })->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.action');

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(
    [
        'middleware' => ['admin'],
        'prefix' => 'admin'
    ],
    function () {
        Route::get('', [AdminController::class, 'index'])->name('admin.index');
        Route::post('delete', [AdminController::class, 'delete'])->name('admin.delete');
        Route::post('recover', [AdminController::class, 'recover'])->name('admin.recover');
    }
);
