<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsColorsId extends Model
{
    protected $table = 'goods_colors_id';
    protected $guarded = 'id';

	public function moduleMultipleImg() {
		return $this->hasOne('App\Models\GoodsColorsId', 'id', 'id');
	}

	public function getGoodsItemColors() {
		return $this->hasOne('App\Models\GoodsItemColors', 'goods_colors_id', 'id');
	}

	public function translates() {
		return $this->hasMany('App\Models\GoodsColors', 'goods_colors_id', 'id');
	}

    public function translate($lang_id) {

	    $translates = $this->translates();
        $translate = $translates->where('lang_id', $lang_id)->first();

        return $translate ?: $translates->first();
    }

    public function langIds(){
	    $translates = $this->translates()->get();

        return $translates->isNotEmpty() ? $translates->keyBy('lang_id')->keys()->toArray() : [];
    }

    public function hasLang($lang_id){
        return in_array($lang_id, $this->langIds());
    }

	public function Basket()
	{
		return $this->hasOne('App\Models\Basket', 'goods_colors_id', 'id');
	}

}
