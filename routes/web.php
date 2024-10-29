<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/only_admin', [AuthController::class, 'onlyAdmins'])->name('onlyAdmins');
Route::get('/only_user', [AuthController::class, 'onlyUsers'])->name('onlyUsers');

Route::get('/delete', [AuthController::class, 'delete'])->name('delete');

