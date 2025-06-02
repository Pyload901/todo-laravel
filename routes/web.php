<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Todo;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Todo routes - protected by authentication
    Route::get('/todo', [Todo::class, 'index'])->name('todo.index');
    Route::post('/todo', [Todo::class, 'store'])->name('todo.store');
    Route::patch('/todo/{id}', [Todo::class, 'update'])->name('todo.update');
    Route::delete('/todo/{id}', [Todo::class, 'destroy'])->name('todo.destroy');
});

// Admin routes - protected by admin middleware
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/todos', [AdminController::class, 'allTodos'])->name('todos');
    Route::patch('/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('users.role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    Route::delete('/todos/{todo}', [AdminController::class, 'deleteTodo'])->name('todos.delete');
});

require __DIR__.'/auth.php';
