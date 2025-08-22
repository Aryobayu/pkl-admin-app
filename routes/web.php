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
// 5. Rute Formulir
Route::get("/formulir", [FormulirController::class, "create"])->name("formulir.create");
Route::post("/formulir", [FormulirController::class, "store"])->name("formulir.store");

// 6. Rute Dashboard User Biasa (dari Breeze)

// 5. Rute Dashboard User Biasa (dari Breeze)
=======
Route::get('/formulir', [WidyaiswaraController::class, 'createJamMengajar'])->name('formulir');

// 6. Rute Dashboard User Biasa (dari Breeze)
>>>>>>> 7aa5bd2 (feat: Menambahkan data materi dan jenis diklat pada WidyaiswaraController)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 7. Grup Rute KHUSUS ADMIN
Route::middleware(['auth', 'admin'])->group(function () {

// 5. Rute Formulir
Route::get("/formulir", [FormulirController::class, "create"])->name("formulir.create");
Route::post("/formulir", [FormulirController::class, "store"])->name("formulir.store");

// 6. Rute Jam Mengajar
Route::get("/jam-mengajar/create", [WidyaiswaraController::class, "createJamMengajar"])->name("jam-mengajar.create");
Route::post("/jam-mengajar", [WidyaiswaraController::class, "storeJamMengajar"])->name("jam-mengajar.store");

// 7. Rute Autentikasi (dari Breeze)
require __DIR__."/auth.php";
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
