<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class GoodsMeasure extends Model
{
    protected $table = 'goods_measure';

    protected $fillable = [
        'goods_measure_id', 'lang_id', 'name',
    ];

    public function measureId()
    {
        return $this->hasOne('App\Models\GoodsMeasureId', 'id', 'goods_measure_id');
    }

}


