<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelola_supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'number', 'address', 'email'
    ];
}
