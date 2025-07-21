<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\StokTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokTransaksiController extends Controller
{
    public function index()
    {
        // Admin: lihat semua
        $transaksis = StokTransaksi::with(['barang', 'creator'])
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        return view('admin.stok_transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('admin.stok_transaksi.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'tipe' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'tanggal_transaksi' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $barang = Barang::findOrFail($request->barang_id);

            $harga = $request->tipe == 'masuk' ? $barang->harga_beli : $barang->harga_jual;
            $total = $harga * $request->jumlah;

            // Ambil siapa yang login (admin)
            $admin = auth('admin')->user();

            // Simpan transaksi
            $transaksi = new StokTransaksi([
                'barang_id' => $barang->id,
                'tipe' => $request->tipe,
                'jumlah' => $request->jumlah,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'keterangan' => $request->keterangan,
                'harga' => $harga,
                'total' => $total,
            ]);

            // Isi polymorphic creator
            $transaksi->creator()->associate($admin);
            $transaksi->save();

            // Update stok
            if ($request->tipe == 'masuk') {
                $barang->stok_sekarang += $request->jumlah;
            } else {
                if ($barang->stok_sekarang < $request->jumlah) {
                    throw new \Exception('Stok tidak mencukupi untuk transaksi keluar.');
                }
                $barang->stok_sekarang -= $request->jumlah;
            }
            $barang->save();

            DB::commit();
            return redirect()->route('admin.stok-transaksi.index')
                ->with('success', 'Transaksi stok berhasil dicatat');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function show(StokTransaksi $stokTransaksi)
    {
        return view('admin.stok_transaksi.show', compact('stokTransaksi'));
    }

    public function destroy(StokTransaksi $stokTransaksi)
    {
        return redirect()->route('admin.stok-transaksi.index')
            ->with('error', 'Penghapusan transaksi stok tidak diizinkan');
    }
}
