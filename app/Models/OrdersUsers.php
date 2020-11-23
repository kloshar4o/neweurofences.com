<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdersUsers extends Model
{
    protected $table = 'orders_users';

    protected $fillable = [
        'orders_id', 'user_ip', 'name', 'email', 'phone', 'descr', 'street', 'district', 'city', 'house','address'
    ];
}
