<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jual_layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_transaksi', 'customer', 'jumlah', 'layanan', 'total_harga'
    ];
}
