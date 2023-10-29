<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok_supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'information', 'product_img','quantity'
    ];

}
