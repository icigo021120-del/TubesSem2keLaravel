<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Pengguna;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes (tanpa authentication)
|--------------------------------------------------------------------------
*/

// ===================== HALAMAN PUBLIK =====================
Route::view('/', 'landing.home')->name('landing.home');
Route::view('/tentang', 'landing.tentang')->name('landing.tentang');
Route::view('/fitur', 'landing.fitur')->name('landing.fitur');

// ===================== SISI PENGGUNA =====================
// ===================== LOGIN / REGISTRASI =====================
Route::get('/login', [AuthController::class, 'showLoginPengguna'])->name('login.pengguna');
Route::post('/login', [AuthController::class, 'loginPengguna'])->name('login.pengguna.submit');
Route::get('/admin/login', [AuthController::class, 'showLoginAdmin'])->name('login.admin');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('login.admin.submit');
Route::get('/registrasi', [AuthController::class, 'showRegister'])->name('register');
Route::post('/registrasi', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->name('pengguna.')->group(function () {
    Route::get('/beranda', [Pengguna\BerandaController::class, 'index'])->name('beranda');

    Route::get('/pantauan', [Pengguna\InfoController::class, 'pantauan'])->name('pantauan');
    Route::get('/peta-risiko', [Pengguna\InfoController::class, 'peta'])->name('peta');
    Route::get('/status-sistem', [Pengguna\InfoController::class, 'status'])->name('status');
    Route::get('/peringatan', [Pengguna\InfoController::class, 'peringatan'])->name('peringatan');
    Route::get('/notifikasi', [Pengguna\InfoController::class, 'notifikasi'])->name('notifikasi');
    Route::get('/rute-evakuasi', [Pengguna\InfoController::class, 'rute'])->name('rute');
    Route::get('/titik-kumpul', [Pengguna\InfoController::class, 'titik'])->name('titik');
    Route::get('/edukasi', [Pengguna\InfoController::class, 'edukasi'])->name('edukasi');

    Route::get('/laporan', [Pengguna\LaporanController::class, 'index'])->name('laporan');
    Route::post('/laporan', [Pengguna\LaporanController::class, 'store'])->name('laporan.store');
    Route::redirect('/darurat', '/laporan')->name('darurat');

    Route::get('/profil', [Pengguna\ProfilController::class, 'edit'])->name('profil');
    Route::put('/profil', [Pengguna\ProfilController::class, 'update'])->name('profil.update');
});

// ===================== SISI ADMIN =====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('laporan', Admin\ReportController::class)
        ->only(['index', 'show', 'update', 'destroy']);

    Route::resource('sensor', Admin\SensorController::class)->except('show');

    Route::resource('rute', Admin\EvacuationRouteController::class)->except('show');

    Route::resource('titik-kumpul', Admin\AssemblyPointController::class)
        ->except('show')
        ->parameters(['titik-kumpul' => 'titik'])
        ->names('titik');

    Route::resource('peringatan', Admin\AlertController::class)->except('show');

    Route::resource('edukasi', Admin\EducationModuleController::class)
        ->except('show')
        ->parameters(['edukasi' => 'modul']);

    Route::resource('pengguna', Admin\UserController::class)->only(['index', 'destroy']);
    Route::patch('pengguna/{pengguna}/role', [Admin\UserController::class, 'toggleRole'])->name('pengguna.role');

    Route::get('log-aktivitas', [Admin\ActivityLogController::class, 'index'])->name('log');

    Route::get('pengaturan', [Admin\PengaturanController::class, 'index'])->name('pengaturan');
    Route::put('pengaturan/profil', [Admin\PengaturanController::class, 'updateProfil'])->name('pengaturan.profil');
    Route::put('pengaturan/password', [Admin\PengaturanController::class, 'updatePassword'])->name('pengaturan.password');
    Route::post('pengaturan/admin', [Admin\PengaturanController::class, 'storeAdmin'])->name('pengaturan.admin');
});
