<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\LaboratoriumController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Halaman Utama (Login Page)
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Routes Login & Logout
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Middleware untuk pengecekan role menggunakan session
Route::middleware(['auth'])->group(function () {

    // Redirect Berdasarkan Role
    Route::get('home', function () {
        return redirect()->route('dashboard');
    })->name('home');

    // Dashboard Global
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Global Routes untuk Semua Controller
    Route::resources([
        'pasiens' => PasienController::class,
        'tindakans' => TindakanController::class,
        'obats' => ObatController::class,
        'kunjungans' => KunjunganController::class,
        'dokters' => DokterController::class,
        'polikliniks' => PoliklinikController::class,
        'laboratoriums' => LaboratoriumController::class,
        'users' => UserController::class,
    ]);

    Route::resource('rekam-medis', RekamMedisController::class)->parameters(['rekam-medis' => 'rekam_medis']);

    // Role-Specific Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    });

    Route::middleware('role:dokter')->prefix('dokter')->name('dokter.')->group(function () {
        Route::get('dashboard', [DokterController::class, 'index'])->name('dashboard');
        Route::resource('rekam-medis', RekamMedisController::class)->parameters(['rekam-medis' => 'rekam_medis'])->only(['index', 'create', 'store', 'edit', 'update']);
        Route::resource('pasiens', PasienController::class)->only(['index', 'show', 'create', 'store']);
    });

    Route::middleware('role:laboratorium')->prefix('laboratorium')->name('laboratorium.')->group(function () {
        Route::get('dashboard', [LaboratoriumController::class, 'index'])->name('dashboard');
        Route::resource('laboratoriums', LaboratoriumController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::resource('rekam-medis', RekamMedisController::class)->only(['index']);
    });

    Route::middleware('role:farmasi')->prefix('farmasi')->name('farmasi.')->group(function () {
        Route::get('dashboard', [ObatController::class, 'index'])->name('dashboard');
        Route::resource('obats', ObatController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::resource('rekam-medis', RekamMedisController::class)->only(['index']);
    });

    Route::middleware('role:perawat')->prefix('perawat')->name('perawat.')->group(function () {
        Route::get('dashboard', [KunjunganController::class, 'index'])->name('dashboard');
        Route::resource('pasiens', PasienController::class)->only(['index', 'show', 'create', 'store']);
        Route::resource('tindakans', TindakanController::class)->only(['index', 'show', 'create', 'store']);
        Route::resource('kunjungans', KunjunganController::class)->only(['index']);
    });

    Route::middleware('role:pasien')->prefix('pasien')->name('pasien.')->group(function () {
        Route::get('dashboard', [RekamMedisController::class, 'index'])->name('dashboard');
        Route::resource('rekam-medis', RekamMedisController::class)->only(['index']);
    });
});

// Halaman Unauthorized
Route::get('/unauthorized', function () {
    return response('Unauthorized', 403);
});
