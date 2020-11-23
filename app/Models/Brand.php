<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Brand extends Model
{
    protected $table = 'goods_brand';

    protected $fillable = [
        'name', 'img', 'active', 'deleted', 'link'
    ];

    public function goodsItemId() {
        return $this->hasOne('App\Models\GoodsItemId', 'brand_id', 'id');
    }

    public function moduleMultipleImg() {
        return $this->hasMany('App\Models\BrandImages', 'brand_id', 'id')->orderBy('position', 'asc');
    }

}