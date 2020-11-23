<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsColors extends Model
{
    protected $table = 'goods_colors';



    protected $fillable = [

        'goods_colors_id', 'lang_id', 'ral', 'hex', 'name'

    ];

	public function getGoodsColorsId() {
		return $this->hasOne('App\Models\GoodsColorsId', 'id', 'goods_colors_id');
	}
}
