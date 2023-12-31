<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::patch('/notes/update', [NoteController::class, 'update'])->name('notes.update');
Route::delete('/notes/delete', [NoteController::class, 'delete'])->name('notes.delete');
