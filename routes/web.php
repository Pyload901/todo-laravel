<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Todo;

Route::get('/todo', [Todo::class, 'index'])->name('todo.index');
Route::post('/todo', [Todo::class, 'store'])->name('todo.store');
Route::delete('/todo/{id}', [Todo::class, 'destroy'])->name('todo.destroy');
Route::patch('/todo/{id}', [Todo::class, 'update'])->name('todo.update');