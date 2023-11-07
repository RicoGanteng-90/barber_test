<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jual_barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_transaksi', 'customer', 'jumlah', 'barang', 'total_harga'
    ];
}
