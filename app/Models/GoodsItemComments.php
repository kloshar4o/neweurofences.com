<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class GoodsItemComments extends Model
{
    protected $table = 'goods_item_comments';

    protected $fillable = [
        'goods_item_id', 'name', 'body', 'email', 'rating', 'ip', 'active', 'seen'
    ];


}

