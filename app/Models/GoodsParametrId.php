<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class GoodsParametrId extends Model
{
    protected $table = 'goods_parametr_id';

    protected $fillable = [
        'goods_subject_id', 'measure_type', 'goods_measure_id', 'parametr_type', 'position', 'active', 'deleted', 'alias', 'show_in_list', 'font_for_list', 'display_on_list_page', 'start_open', 'display_in_line'
    ];

}

