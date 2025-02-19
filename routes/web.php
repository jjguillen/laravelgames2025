<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameListController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
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

    Route::get('/dashboard/games', [GameController::class, 'indexA'] )->name('admin.games.index');
    Route::get('/dashboard/users', [RegisteredUserController::class, 'indexA'] )->name('admin.users.index');
    Route::get('/dashboard/reviews', [ReviewController::class, 'indexA'] )->name('admin.reviews.index');



});

/**
 * Rutas para el usuario
 */
Route::middleware(['auth'])->group( function () {
    Route::get('/games', [GameController::class, 'index'] )->name('games.index');
    Route::get('/games/{game}', [GameController::class, 'show'] )->name('games.show');
    Route::post('/games/review/{game}', [GameController::class, 'review'] )->name('games.review');

    Route::get('/lists', [GameListController::class, 'index'] )->name('lists.index');
    Route::post('/lists/store', [GameListController::class, 'store'] )->name('lists.store');
    Route::get('/lists/{list}', [GameListController::class, 'show'] )->name('lists.show');
    Route::get('/lists/delete/{list}', [GameListController::class, 'destroy'] )->name('lists.destroy');
    Route::get('/lists/showtoadd/{game}', [GameListController::class, 'showtoadd'] )->name('lists.showtoadd');
    Route::get('/lists/addgame/{list}/{game}', [GameListController::class, 'addGameToList'] )->name('lists.addgame');
    Route::get('/lists/removegame/{list}/{game}', [GameListController::class, 'removeGameFromList'] )->name('lists.removegame');
});


require __DIR__.'/auth.php';
