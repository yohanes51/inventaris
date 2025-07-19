<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\StokTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokTransaksiController extends Controller
{
    public function index()
    {
        // Hanya menampilkan transaksi keluar
        $transaksis = StokTransaksi::with('barang')
            ->where('tipe', 'keluar')
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        return view('stok_transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('stok_transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $barang = Barang::findOrFail($request->barang_id);

            if ($barang->stok_sekarang < $request->jumlah) {
                throw new \Exception('Stok tidak mencukupi untuk transaksi keluar.');
            }

            $harga = $barang->harga_jual;
            $total = $harga * $request->jumlah;

            $transaksi = new StokTransaksi([
                'barang_id' => $barang->id,
                'tipe' => 'keluar', // Tetap dan tidak bisa diubah
                'jumlah' => $request->jumlah,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'keterangan' => $request->keterangan,
                'harga' => $harga,
                'total' => $total,
            ]);
            $transaksi->save();

            // Kurangi stok
            $barang->stok_sekarang -= $request->jumlah;
            $barang->save();

            DB::commit();

            return redirect()->route('stok-transaksi.index')
                ->with('success', 'Transaksi keluar berhasil dicatat');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function show(StokTransaksi $stokTransaksi)
    {
        // Batasi hanya transaksi keluar yang bisa dilihat user
        if ($stokTransaksi->tipe !== 'keluar') {
            abort(403, 'Akses ditolak.');
        }

        return view('stok_transaksi.show', compact('stokTransaksi'));
    }

    public function destroy(StokTransaksi $stokTransaksi)
    {
        // User tidak bisa menghapus transaksi
        return redirect()->route('stok-transaksi.index')
            ->with('error', 'Penghapusan transaksi tidak diizinkan');
    }
}