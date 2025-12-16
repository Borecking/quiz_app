<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

//Tylko dla zalogowanych
Route::middleware(['auth', 'verified'])->group(function () {
    
    //uzytkownik
    Route::get('/dashboard', [QuizController::class, 'index'])->name('dashboard');
    Route::post('/join', [QuizController::class, 'join'])->name('quiz.join');
    Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quiz.show');
    Route::post('/quiz/{quiz}', [QuizController::class, 'submit'])->name('quiz.submit');

    //admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/quiz/{quiz}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/quiz/{quiz}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/quiz/{quiz}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/quiz/{quiz}', [AdminController::class, 'destroy'])->name('admin.destroy');

    //profil z breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';