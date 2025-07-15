<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    //

    public function index()
    {
        return view('laporan.index');
    }

    public function stokHarian(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
        ]);

        $tanggal = $request->tanggal;
        
        $transaksis = StokTransaksi::with('barang')
            ->whereDate('tanggal_transaksi', $tanggal)
            ->orderBy('tanggal_transaksi', 'asc')
            ->get();
            
        $summary = [
            'total_masuk' => $transaksis->where('tipe', 'masuk')->sum('jumlah'),
            'total_keluar' => $transaksis->where('tipe', 'keluar')->sum('jumlah'),
            'jumlah_transaksi' => $transaksis->count(),
        ];
        
        return view('laporan.stok_harian', compact('transaksis', 'tanggal', 'summary'));
    }

    public function stokBulanan(Request $request)
    {
        $request->validate([
            'bulan' => 'required|date_format:Y-m',
        ]);

        $bulan = $request->bulan;
        $tahun = substr($bulan, 0, 4);
        $bulanNum = substr($bulan, 5, 2);
        
        $transaksis = DB::table('stok_transaksis')
            ->join('barangs', 'stok_transaksis.barang_id', '=', 'barangs.id')
            ->select(
                DB::raw('DATE(tanggal_transaksi) as tanggal'),
                DB::raw('SUM(CASE WHEN tipe = "masuk" THEN jumlah ELSE 0 END) as total_masuk'),
                DB::raw('SUM(CASE WHEN tipe = "keluar" THEN jumlah ELSE 0 END) as total_keluar'),
                DB::raw('COUNT(*) as jumlah_transaksi')
            )
            ->whereYear('tanggal_transaksi', $tahun)
            ->whereMonth('tanggal_transaksi', $bulanNum)
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();
            
        $summary = [
            'total_masuk' => $transaksis->sum('total_masuk'),
            'total_keluar' => $transaksis->sum('total_keluar'),
            'jumlah_hari' => $transaksis->count(),
        ];
        
        return view('laporan.stok_bulanan', compact('transaksis', 'bulan', 'summary'));
    }

    public function stokBarang()
    {
        $barangs = Barang::with('kategori')->get();
        
        $stokKritis = $barangs->filter(function($item) {
            return $item->stok_sekarang <= $item->stok_minimum;
        });
        
        return view('laporan.stok_barang', compact('barangs', 'stokKritis'));
    }
}