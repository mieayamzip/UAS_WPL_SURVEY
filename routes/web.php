<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\DataKeluargaController;
use App\Http\Controllers\DataPekerjaanPendapatanController;
use App\Http\Controllers\DataRumahController;
use App\Http\Controllers\DataKendaraanController;
use App\Http\Controllers\SkorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExportController;


// ===========================
// AUTH
// ===========================
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===========================
// DASHBOARD
// ===========================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// ===========================
// SURVEY
// ===========================
Route::resource('survey', SurveyController::class);

// ===========================
// DATA KELUARGA
// ===========================
Route::resource('keluarga', DataKeluargaController::class);

// ===========================
// DATA PEKERJAAN & PENDAPATAN
// ===========================
Route::get('/pekerjaan', [DataPekerjaanPendapatanController::class, 'index'])->name('pekerjaan.index');
Route::get('/pekerjaan/create', [DataPekerjaanPendapatanController::class, 'create'])->name('pekerjaan.create');
Route::post('/pekerjaan', [DataPekerjaanPendapatanController::class, 'store'])->name('pekerjaan.store');

// ===========================
// DATA RUMAH
// ===========================
Route::resource('rumah', DataRumahController::class);
// ===========================
// DATA KENDARAAN
// ===========================
Route::get('/kendaraan', [DataKendaraanController::class, 'index'])->name('kendaraan.index');
Route::get('/kendaraan/create', [DataKendaraanController::class, 'create'])->name('kendaraan.create');
Route::post('/kendaraan', [DataKendaraanController::class, 'store'])->name('kendaraan.store');

// ===========================
// SKOR
// ===========================
Route::get('/skor', [SkorController::class, 'index'])->name('skor.index');
Route::post('/skor', [SkorController::class, 'store'])->name('skor.store');

// ===========================
// PROFILE
// ===========================
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
// ===========================
// EXPORT KE PDF
// ===========================

Route::get('/export', [ExportController::class, 'index'])->name('export.index');
Route::get('/export/{survey}', [ExportController::class, 'exportPdf'])->name('export.pdf');
