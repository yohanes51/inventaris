<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokTransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Kategori Routes
    Route::resource('kategori', KategoriController::class);

    // Barang Routes
    Route::resource('barang', BarangController::class);

    // Stok Transaksi Routes
    Route::resource('stok-transaksi', StokTransaksiController::class);

    // Laporan Routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/stok-harian', [LaporanController::class, 'stokHarian'])->name('laporan.stok-harian');
    Route::get('/laporan/stok-bulanan', [LaporanController::class, 'stokBulanan'])->name('laporan.stok-bulanan');
    Route::get('/laporan/stok-barang', [LaporanController::class, 'stokBarang'])->name('laporan.stok-barang');
});

require __DIR__.'/auth.php';
