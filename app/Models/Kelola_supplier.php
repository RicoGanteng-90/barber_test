<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelola_supplier extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "kelola_suppliers";
    protected $fillable = [
        'name', 'number', 'address', 'email', 'deleted_at'
    ];


}
