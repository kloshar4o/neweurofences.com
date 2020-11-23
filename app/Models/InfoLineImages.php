<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoLineImages extends Model
{
    protected $table = 'info_line_images';

    protected $fillable = [
        'info_item_id', 'img', 'active', 'position'
    ];


}
