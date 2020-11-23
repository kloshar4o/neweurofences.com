<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsSubjectId extends Model
{
    protected $table = 'goods_subject_id';

    protected $fillable = [
        'p_id', 'alias', 'active', 'deleted', 'level', 'position', 'img'
    ];

    public function goodsItemId(){
        return $this->hasOne('App\Models\GoodsItemId', 'goods_subject_id', 'goods_subject_id');
    }
    public function getOneImg() {
        return $this->hasOne('App\Models\GoodsImages', 'goods_subject_id', 'goods_subject_id')->orderBy('position', 'asc');
    }
    public function getSecondImg() {
        return $this->hasOne('App\Models\GoodsImages', 'goods_subject_id', 'goods_subject_id')->orderBy('position', 'desc');
    }
    public function moduleMultipleImg() {
        return $this->hasMany('App\Models\GoodsImages', 'goods_subject_id', 'goods_subject_id')->orderBy('position', 'asc');
    }

}