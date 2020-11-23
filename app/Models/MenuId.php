<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuId extends Model
{
    protected $table = 'menu_id';

    protected $fillable = [
        'p_id', 'level', 'alias', 'page_type', 'position', 'active', 'deleted', 'img', 'top_menu', 'footer_menu', 'link'
    ];


    public function menu() {
        return $this->hasMany('App\Models\Menu', 'menu_id', 'id');
    }

    public function moduleMultipleImg() {
        return $this->hasMany('App\Models\MenuImages', 'menu_id', 'id')->orderBy('position', 'asc');
    }

    public function oneImage() {
        return $this->hasOne('App\Models\MenuImages', 'menu_id', 'menu_id');
    }
}
