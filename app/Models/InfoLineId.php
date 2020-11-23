<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoLineId extends Model
{
    protected $table = 'info_line_id';

    protected $fillable = [
        'alias', 'active', 'deleted', 'img_m_w', 'img_m_h', 'has_big_img', 'img_b_w', 'img_b_h', 'position'
    ];
}