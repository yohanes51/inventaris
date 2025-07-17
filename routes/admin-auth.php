<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StokTransaksiController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['verified'])->name('dashboard');

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Kategori Routes
    Route::resource('kategori', KategoriController::class);

    // Barang Routes
    Route::resource('barang', BarangController::class);

    // Stok Transaksi Routes
    Route::resource('stok-transaksi', StokTransaksiController::class);
    Route::get('/stok-transaksi/create/masuk', [StokTransaksiController::class, 'create'])->name('stok-transaksi.create.masuk');
    Route::get('/stok-transaksi/create/keluar', [StokTransaksiController::class, 'create'])->name('stok-transaksi.create.keluar');


    // Laporan Routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/stok-harian', [LaporanController::class, 'stokHarian'])->name('laporan.stok-harian');
    Route::get('/laporan/stok-bulanan', [LaporanController::class, 'stokBulanan'])->name('laporan.stok-bulanan');
    Route::get('/laporan/stok-barang', [LaporanController::class, 'stokBarang'])->name('laporan.stok-barang');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
