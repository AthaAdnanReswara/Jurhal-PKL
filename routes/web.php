<?php

use App\Http\Controllers\Admin\DudiController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PembimbingController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembimbingSiswaController;
use App\Http\Controllers\Siswa\AbsensiController;
use App\Http\Controllers\Siswa\KegiatanController;
use App\Http\Controllers\Siswa\ProfilSiswaController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('auth.login');
});

// Auth routes  logout
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//prefik untuk admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'login'])->name('dashboard');
    // route tambah user/siswa
    Route::resource('siswa', AdminSiswaController::class);
    //kelas
    Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
    //Jurusan
    Route::resource('jurusan', JurusanController::class);
    //Dudi
    Route::resource('dudi', DudiController::class);
    //Pembimbing
    Route::resource('pembimbing', PembimbingController::class);
    //kegiatan
    Route::get('/kegiatan', [KegiatanController::class, 'kegiatan'])->name('kegiatan');
    //Absensi
    Route::get('/absensi', [AbsensiController::class, 'absensi'])->name('absensi');
});

Route::prefix('siswa')->name('siswa.')->middleware(['auth', 'role:siswa'])->group(function () {
    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'login'])->name('dashboard');
    //kegiatan siswa
    Route::resource('kegiatan', KegiatanController::class);
    //Absensi siswa
    Route::resource('absensi', AbsensiController::class);
    Route::get('/absensi/pulang/{id}', [AbsensiController::class, 'absenPulang'])->name('absensi.pulang');
    //Profail Siswa
    Route::resource('profile', ProfilSiswaController::class);
});

Route::prefix('pembimbing')->name('pembimbing.')->middleware(['auth', 'role:pembimbing'])->group(function () {
    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'login'])->name('dashboard');
    //siswa
    Route::resource('siswa', PembimbingSiswaController::class);
    Route::get('/siswa/kegiatan/{id}', [PembimbingSiswaController::class, 'siswaKegiatan'])->name('siswa.kegiatan');
}); 
