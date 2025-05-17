<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Aturan;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\KnnController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\KehamilanController;
use App\Http\Controllers\UjiCobaController;
use App\Http\Controllers\KelahiranController;
use App\Http\Controllers\DashboardController;

require __DIR__ . '/auth.php';
Route::get('pass', function () {
    return bcrypt('qweqweqwe');
});
Route::get('/', function () {
    return view('front');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/export', [PasienController::class, 'export']);

Route::get('user', [App\Http\Controllers\Aturan::class, 'index'])->middleware(['auth', 'role:user'])->name('admin.users');
Route::get('admin', [App\Http\Controllers\Aturan::class, 'admin'])->middleware(['auth', 'role:admin']);

Route::middleware(['auth'])->group(function () {
    Route::resource('pasien', PasienController::class);
    Route::get('pasien/hapus/{pasien}', [PasienController::class, 'destroy'])->name('hapus.pasien');

    Route::get('pasien/{pasien}/{kehamilan?}', [PasienController::class, 'show'])->name('pasien.kunjungan');

    Route::resource('knn', KnnController::class);

    Route::resource('kehamilan', KehamilanController::class);
    Route::get('kehamilan/tambah/{id?}', [KehamilanController::class, 'create'])->name('kehamilan.tambah');

    Route::get('hitung/{req?}', [UjiCobaController::class, 'hitung'])->name('ujicoba.hitung');
    Route::get('form-proses', [UjiCobaController::class, 'formProses'])->name('ujicoba.form-proses');
    Route::post('proses', [UjiCobaController::class, 'proses'])->name('ujicoba.proses');

    Route::resource('kunjungan', KunjunganController::class);
    Route::get('/kunjungan/tambah/{pasien}/{kehamilan}', [KunjunganController::class, 'tambah'])->name('kunjungan.pasien.tambah');
    Route::get('kunjungan/{pasien}/{kehamilan}', [KunjunganController::class, 'kunjunganPasienDetail'])->name('kunjungan_pasien_detail');

    Route::get('/kunjungan/hitung/{pasien}/{kehamilan}/{kunjungan}', [KunjunganController::class, 'hitungKnn'])->name('kunjungan.pasien.hitungknn');

    // test knn full
    Route::get('/ujiknn/{pasien}/{kehamilan}/{kunjungan}', [UjiCobaController::class, 'ujiKNN'])->name('ujiknn');

    // detail kehamilan dan kunjungan ajax
    Route::get('kehamilan-ajax/{pasien}/{kehamilan}', [PasienController::class, 'kehamilanAjax']);

    Route::resource('kelahiran', KelahiranController::class);

    Route::view('form', 'form');
});
