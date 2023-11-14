<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelola_barang extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'price', 'information', 'product_img', 'quantity', 'deleted_at'
    ];
}
