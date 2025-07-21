<?php

namespace App\Http\Controllers;

use App\Models\Barang;

class BarangController extends Controller
{
    public function dashboard()
    {
        $barangs = Barang::with('kategori')->get();
        return view('dashboard', compact('barangs'));
    }


}