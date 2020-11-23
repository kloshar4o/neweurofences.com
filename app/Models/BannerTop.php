<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerTop extends Model
{

    protected $table = 'banner_top';

    protected $fillable = [
        'banner_top_id', 'lang_id', 'img', 'name', 'body', 'link'
    ];

    public function bannerTopId()
    {
        return $this->hasOne('App\Models\BannerTopId', 'id', 'banner_top_id');
    }

    public function lang()
    {
        return $this->hasOne('App\Models\Lang', 'id', 'lang_id');
    }
}
