<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class GoodsItemId extends Model
{
    protected $table = 'goods_item_id';

    protected $fillable = [
        'sku', 'goods_subject_id', 'p_id_other', 'alias', 'active', 'deleted', 'one_c_code', 'position', 'show_on_main', 'add_date', 'popular_element', 'new_element','goods_set', 'brand_id', 'price','weight','complect', 'recomend'
    ];


    static public $lang_id;

    public function getPhoto() {
      return $this->hasOne('App\Models\GoodsPhoto', 'goods_item_id', 'id');

    }


    public function getSubjectId() {
        return $this->hasOne('App\Models\GoodsSubjectId', 'id', 'goods_subject_id');
    }

    public function getBannerId() {
        return $this->hasOne('App\Models\Brand', 'id', 'brand_id');
    }

    public function goodsItem() {
        return $this->hasMany('App\Models\GoodsItem', 'goods_item_id', 'id');
    }

    public function goodsSubjectId() {
        return $this->hasOne('App\Models\GoodsSubjectId', 'id', 'goods_subject_id');
    }

}

