<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'product', 'order_time', 'event_time', 'total', 'payment_method', 'order_status', 'payment_status','total_price', 'order_img'
    ];
}
