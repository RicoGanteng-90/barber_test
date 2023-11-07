<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelola_layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'note_service', 'img_service', 'status'
    ];
}
