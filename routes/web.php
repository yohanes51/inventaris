<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokTransaksiController;
use App\Http\Controllers\BarangController;
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

    Route::get('stok-transaksi', [StokTransaksiController::class, 'index'])->name('stok-transaksi.index');
    Route::get('stok-transaksi/create', [StokTransaksiController::class, 'create'])->name('stok-transaksi.create');
    Route::post('stok-transaksi', [StokTransaksiController::class, 'store'])->name('stok-transaksi.store');
    Route::get('stok-transaksi/{stokTransaksi}', [StokTransaksiController::class, 'show'])->name('stok-transaksi.show');

    Route::get('/dashboard', [BarangController::class, 'dashboard'])->name('dashboard');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';