<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{

    protected $table = 'basket';

    protected $fillable = [
        'basket_id','goods_item_id','items_count','goods_name','goods_price','one_c_code','goods_colors_id'
    ];

	public function BasketId() {
		return $this->hasOne('App\Models\BasketId', 'basket_id', 'id');
	}

	public function GoodsItemId() {
		return $this->hasOne('App\Models\GoodsItemId', 'id', 'goods_item_id');
	}
}
