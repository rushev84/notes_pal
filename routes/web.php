<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\NoteController;
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
Route::middleware('auth')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
});

Route::get('/register', [RegisterController::class, 'index'])->name('register.index');

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

// API?
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'enter'])->name('login.enter');

Route::post('/notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/notes/update', [NoteController::class, 'update'])->name('notes.update');
Route::post('/notes/delete', [NoteController::class, 'delete'])->name('notes.delete');
