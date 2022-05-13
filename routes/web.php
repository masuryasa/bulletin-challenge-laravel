<?php

use App\Http\Controllers\{MessageController, UserController, LoginController};
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

Route::get('/', function () {
    return redirect('messages');
});
Route::get('login', [LoginController::class, 'login'])->name('messages.login');
Route::post('login', [LoginController::class, 'authenticate'])->name('messages.login.action');
Route::get('logout', [LoginController::class, 'logout'])->name('messages.logout');

Route::post('password-validation', [MessageController::class, 'passwordValidation']);

Route::resource('messages', MessageController::class);

Route::prefix('register')->group(function () {
    Route::get('', [UserController::class, 'index'])->name('register-form');
    Route::post('', [UserController::class, 'register'])->name('register');
    Route::post('confirm', [UserController::class, 'confirm'])->name('confirm');

    Route::get('/email/verify', [UserController::class, 'registerNotification'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('messages.index');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});
