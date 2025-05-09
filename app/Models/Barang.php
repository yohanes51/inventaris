<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id', 'kode_barang', 'nama_barang', 'deskripsi',
        'stok_minimum', 'stok_sekarang', 'harga_beli', 'harga_jual'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function stokTransaksis()
    {
        return $this->hasMany(StokTransaksi::class);
    }
}