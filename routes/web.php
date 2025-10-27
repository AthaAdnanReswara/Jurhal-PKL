<?php

use App\Http\Controllers\Admin\DudiController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PembimbingController;
use App\Http\Controllers\AdminConroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('auth.login');
});

// Auth routes  logout
Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//prefik untuk admin routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (){
    //Dashboard
    Route::get('dashboard', [DashboardController::class, 'login'])->name('dashboard');
    // route tambah user/siswa
    Route::get('/siswa/index', [AdminConroller::class, 'indexSiswa'])->name('siswa.index');
    Route::get('/siswa/store', [AdminConroller::class, 'tambahSiswa'])->name('siswa.create');
    Route::post('/siswa/tambah', [AdminConroller::class, 'tambahSiswaStore'])->name('tambah.siswa.store');
    //kelas
    Route::resource('kelas', KelasController::class)->parameters(['kelas' => 'kelas']);
    //Jurusan
    Route::resource('jurusan', JurusanController::class);
    //Dudi
    Route::resource('dudi', DudiController::class);
    //Pembimbing
    Route::resource('pembimbing',PembimbingController::class);

});

Route::prefix('siswa')->name('siswa.')->middleware('auth')->group(function (){
    //Dashboard
    Route::get('dashboard',[DashboardController::class, 'login'])->name('dashboard');
});

Route::middleware(['auth', 'role:pembimbing'])->group(function (){
    
});

