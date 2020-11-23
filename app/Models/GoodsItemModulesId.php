<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class GoodsItemModulesId extends Model
{
    protected $table = 'goods_item_modules_id';

    protected $fillable = [
        'goods_item_id', 'position'
    ];

    public function goodsItemId(){
        return $this->hasOne('App\Models\GoodsItemId', 'id', 'goods_item_id');
    }
}

