<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsItemIdSet extends Model
{
    protected $table = 'goods_items_set';

    protected $fillable = [
        'goods_item_id', 'set_goods_item_id', 'set_items_number'
    ];

}