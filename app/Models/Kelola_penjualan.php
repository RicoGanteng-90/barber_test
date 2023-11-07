<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelola_penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_customer', 'email_customer', 'no_telp', 'tanggal_transaksi', 'customer', 'tanggal_pemesanan', 'barang', 'jumlah', 'total', 'harga'
    ];
}
