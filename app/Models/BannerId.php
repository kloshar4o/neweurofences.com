<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerId extends Model
{

    protected $table = 'banner_id';

    protected $fillable = [
        'img', 'link', 'active', 'deleted'
    ];

    public function moduleMultipleImg() {
        return $this->hasMany('App\Models\BannerImages', 'banner_id', 'id')->orderBy('position', 'asc');
    }

}
