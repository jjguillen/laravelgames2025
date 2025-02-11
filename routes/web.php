<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/**
 * Rutas para el administrador
 */
Route::middleware(['auth', 'role:admin'])->group(function () {
    //Todo lo que solo pueda hacer un admin
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');



});

/**
 * Rutas para el usuario
 */
Route::middleware(['auth'])->group( function () {
    Route::get('/games', [GameController::class, 'index'] )->name('games.index');
    Route::get('/games/{game}', [GameController::class, 'show'] )->name('games.show');


});


require __DIR__.'/auth.php';
