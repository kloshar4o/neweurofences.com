<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class GoodsParametrValueId extends Model
{
    protected $table = 'goods_parametr_value_id';

    protected $fillable = [
        'goods_parametr_id', 'position', 'active'
    ];

}