<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class GoodsParametrItemId extends Model
{
    protected $table = 'goods_parametr_item_id';

    protected $fillable = [
        'goods_item_id', 'goods_parametr_id'
    ];



}

