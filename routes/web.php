<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LogAktivitasController;
use Illuminate\Support\Facades\Route;

Route::get('/masuk', function () {
    return view('pages.login');
})->name('masuk')->middleware('guest');
Route::post('/masuk', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/log_aktivitas', [LogAktivitasController::class, 'index'])->name('log_aktivitas.index');

    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index')->middleware('can:admin');
    Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.create')->middleware('can:admin');
    Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan.store')->middleware('can:admin');
    Route::get('/karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawan.edit')->middleware('can:admin');
    Route::put('/karyawan/update/{id}', [KaryawanController::class, 'update'])->name('karyawan.update')->middleware('can:admin');
    Route::delete('/karyawan/destroy/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy')->middleware('can:admin');

    Route::get('/profil/show/{id}', [AuthController::class, 'show'])->name('profil.index');
    Route::get('/profil/edit/{id}', [AuthController::class, 'editProfil'])->name('profil.edit');
    Route::put('/profil/update_profil/{id}', [AuthController::class, 'updateProfil'])->name('profil.update_profil');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index')->middleware('can:admin');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create')->middleware('can:admin');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store')->middleware('can:admin');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit')->middleware('can:admin');
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update')->middleware('can:admin');
    Route::delete('/kategori/destroy', [KategoriController::class, 'destroy'])->name('kategori.destroy')->middleware('can:admin');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index')->middleware('can:admin');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create')->middleware('can:admin');
    Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store')->middleware('can:admin');
    Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit')->middleware('can:admin');
    Route::put('/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update')->middleware('can:admin');
    Route::get('/menu/show/{id}', [MenuController::class, 'show'])->name('menu.show');
    Route::delete('/menu/destroy/{id}', [MenuController::class, 'destroy'])->name('menu.destroy')->middleware('can:admin');

    Route::get('/meja', [MejaController::class, 'index'])->name('meja.index')->middleware('can:admin');
    Route::get('/meja/create', [MejaController::class, 'create'])->name('meja.create')->middleware('can:admin');
    Route::post('/meja/store', [MejaController::class, 'store'])->name('meja.store')->middleware('can:admin');
    Route::get('/meja/edit/{id}', [MejaController::class, 'edit'])->name('meja.edit')->middleware('can:admin');
    Route::put('/meja/update/{id}', [MejaController::class, 'update'])->name('meja.update')->middleware('can:admin');
    Route::delete('/meja/destroy', [MejaController::class, 'destroy'])->name('meja.destroy')->middleware('can:admin');

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/show/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::put('/transaksi/update/{id}', [TransaksiController::class, 'update'])->name('transaksi.update');
    Route::get('/transaksi/nota/{id}', [TransaksiController::class, 'nota'])->name('transaksi.nota');
    Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
});
