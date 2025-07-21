<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id', 'tipe', 'jumlah', 'keterangan',
        'harga', 'total', 'tanggal_transaksi'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function creator()
    {
        return $this->morphTo();
    }
}