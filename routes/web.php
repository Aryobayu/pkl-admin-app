<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WidyaiswaraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FormulirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Rute Halaman Utama
Route::get('/', [PageController::class, 'home'])->name('home');

// 2. Rute Profil Widyaiswara 
Route::get('/profil-widyaiswara', [WidyaiswaraController::class, 'index'])->name('Profil.Widyaiswara');

// 3. Rute Info Ajar
Route::get('/info-ajar', [PageController::class, 'infoajar'])->name('info.ajar');

// 4. Rute Statistik
Route::get('/statistik', [PageController::class, 'statistik'])->name('statistik');

// 5. Rute Formulir
// Route::get('/formulir', [PageController::class, 'formulir'])->name('formulir');
Route::get('/formulir', [FormulirController::class, 'create'])->name('formulir.create');
Route::post('/formulir', [FormulirController::class, 'store'])->name('formulir.store');


// 5. Rute Dashboard User Biasa (dari Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 6. Grup Rute KHUSUS ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
});

// 7. Rute Profil (dari Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 8. Rute Autentikasi (dari Breeze)
require __DIR__.'/auth.php';
