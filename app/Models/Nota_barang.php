<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota_barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_transaksi', 'supplier', 'jumlah', 'barang', 'total'
    ];
}
