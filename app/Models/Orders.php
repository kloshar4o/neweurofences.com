<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'basket_id', 'type', 'admin_comment', 'active', 'delete', 'fast_order', 'delivery_method', 'pay_method', 'discount'
    ];

    public function ordersData()
    {
        return $this->hasOne('App\Models\OrdersData', 'orders_id', 'id');
    }

    public function ordersUsers()
    {
        return $this->hasOne('App\Models\OrdersUsers', 'orders_id', 'id');
    }

    public function basket()
    {
        return $this->hasMany('App\Models\Basket', 'basket_id', 'basket_id');
    }
}
