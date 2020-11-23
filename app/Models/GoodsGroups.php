<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoodsGroups extends Model
{
    protected $table = 'goods_groups';


    protected $fillable = [

        'id',  'lang_id', 'name', 'created_at','updated_at', 'goods_groups_id'

    ];


}
