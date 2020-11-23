<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersData extends Model
{
    protected $table = 'orders_data';

    protected $fillable = [
        'orders_id', 'total_price', 'total_count'
    ];
}
