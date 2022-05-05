<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AdminController::class, 'login'])->name('admins.login');
Route::post('login', [AdminController::class, 'authenticate'])->name('admins.login.action');
Route::get('logout', [AdminController::class, 'logout'])->name('admins.logout');

Route::group(
    [
        'middleware' => ['admin'],
    ],
    function () {
        Route::resource('', AdminController::class)->only('index');
        Route::post('destroy', [AdminController::class, 'destroy'])->name('admins.destroy');
        Route::post('restore/{id}', [AdminController::class, 'restore'])->name('admins.restore');
    }
);
