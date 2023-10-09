<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'enter'])->name('login.enter');

//
Route::post('/notes/create', [NoteController::class, 'create'])->name('notes.create');
