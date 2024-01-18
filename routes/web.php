<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KomentarFotoController;
use App\Http\Controllers\LikeFotoController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/homepage', function () {
//     return view('lib.homepage', ['title' => 'Homepage | Gallery']);
// })->middleware(['auth', 'verified'])->name('homepage');

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage');
});

Route::middleware('auth')->group(function () {
    Route::get('/album', [AlbumController::class, 'index'])->name('album.index');
    Route::post('/album/store', [AlbumController::class, 'store'])->name('album.store');
    Route::get('/album/detail/{album}', [AlbumController::class, 'show'])->name('album.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/galeri_foto', [FotoController::class, 'index'])->name('foto.index');
    Route::post('/galeri_foto/store', [FotoController::class, 'store'])->name('foto.store');
    Route::get('/galeri_foto/detail/{foto}', [FotoController::class, 'show'])->name('foto.show');
    Route::put('/galeri_foto/update/{foto}', [FotoController::class, 'update'])->name('foto.update');
    Route::delete('/galeri_foto/destroy/{foto}', [FotoController::class, 'destroy'])->name('foto.destroy');
    Route::post('/foto/{foto}/like', [FotoController::class, 'toggleLike'])->name('foto.like');
});

Route::middleware('auth')->group(function () {
    Route::get('/disukai', [LikeFotoController::class, 'index'])->name('like.index');
});

Route::middleware('auth')->group(function () {
    Route::post('/komentar/store', [KomentarFotoController::class, 'store'])->name('komentar.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
