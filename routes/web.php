<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Redirect the root URL to the login page
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'ms.dashboard')->name('dashboard');

    Route::get('/movies/{id?}', function () {
        return view('ms.movies.show');
    })->name('movies.show');

    // If you want a separate “movie list page” later:
    Route::view('/movies', 'ms.movies.show')->name('movies.index');

    Route::get('/me', function () {
        return view('ms.profile', [
            'genres' => ['Mystery', 'Adventures', 'Crime', 'Animations', 'Romance', 'Comedy', 'Musical', 'Sci-Fi', 'Drama', 'Horror'],
            'reco' => ['Mama Mia', 'The Conjuring', 'Inception', 'Ready Player One'],
        ]);
    })->name('me');
    Route::view('/payment', 'ms.payment')->name('payment');
});
