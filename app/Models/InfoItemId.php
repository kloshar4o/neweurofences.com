<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InfoItemId extends Model
{
    protected $table = 'info_item_id';

    protected $fillable = [
        'info_line_id', 'alias', 'is_public', 'active', 'deleted', 'img', 'show_img', 'add_date', 'category'
    ];

    public function infoLineId()
    {
        return $this->hasMany('App\Models\InfoLineId', 'id', 'info_line_id');
    }

    public function infoItem()
    {
        return $this->hasMany('App\Models\InfoItem', 'info_item_id', 'id');
    }

    public function moduleMultipleImg() {
        return $this->hasMany('App\Models\InfoLineImages', 'info_item_id', 'id')->orderBy('position', 'asc');
    }
}