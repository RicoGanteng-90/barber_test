<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelola_pemesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_customer', 'email_customer','no_telp' ,'product', 'tanggal_transaksi', 'tanggal_pemesanan', 'metode_pembayaran', 'status_pemesanan', 'status_pembayaran','total_bayar', 'order_img'
    ];
}
