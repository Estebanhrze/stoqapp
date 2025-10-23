<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ActivityController;

// Landing y páginas públicas
Route::view('/', 'landing')->name('landing');
Route::view('/nosotros', 'about')->name('about');
Route::view('/soluciones', 'solutions')->name('solutions');
Route::view('/contactos', 'contact')->name('contact');
Route::view('/dashboard', 'dashboard')->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/historial', [ActivityController::class, 'index'])->name('activity.index');
});



// Zona autenticada
Route::middleware(['auth','verified'])->group(function () {
    Route::resource('products', ProductController::class)
        ->only(['index','create','store','edit','update','destroy']);

    // Rutas de perfil Breeze
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth (login/register/etc. de Breeze)
require __DIR__.'/auth.php';
