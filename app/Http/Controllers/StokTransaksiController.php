<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokTransaksiController extends Controller
{
    public function index()
    {
        $transaksis = StokTransaksi::with('barang')->orderBy('tanggal_transaksi', 'desc')->get();
        return view('stok-transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('stok-transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tipe' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        // Hitung total harga
        $total = $request->jumlah * $request->harga;

        DB::beginTransaction();
        try {
            // Buat transaksi
            $transaksi = new StokTransaksi($request->all());
            $transaksi->total = $total;
            $transaksi->save();

            // Update stok barang
            $barang = Barang::findOrFail($request->barang_id);

            if ($request->tipe == 'masuk') {
                $barang->stok_sekarang += $request->jumlah;
            } else {
                // Validasi stok keluar
                if ($barang->stok_sekarang < $request->jumlah) {
                    throw new \Exception('Stok tidak mencukupi untuk transaksi keluar.');
                }
                $barang->stok_sekarang -= $request->jumlah;
            }

            $barang->save();

            DB::commit();
            return redirect()->route('stok-transaksi.index')
                ->with('success', 'Transaksi stok berhasil dicatat');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function show(StokTransaksi $stokTransaksi)
    {
        return view('stok_transaksi.show', compact('stokTransaksi'));
    }

    public function destroy(StokTransaksi $stokTransaksi)
    {
        // Tidak direkomendasikan menghapus transaksi stok
        // Jika ingin menghapus, harus dikembalikan juga stok barangnya
        return redirect()->route('stok-transaksi.index')
            ->with('error', 'Penghapusan transaksi stok tidak diizinkan');
    }
}
