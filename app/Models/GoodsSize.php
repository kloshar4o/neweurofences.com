<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsSize extends Model
{
    protected $table = 'goods_size';

    protected $guarded = ['id'];

    public function goodsItemId(){
        return $this->hasOne('App\Models\GoodsItemId', 'id', 'goods_item_id');
    }

}
