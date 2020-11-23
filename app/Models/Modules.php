<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $table = 'modules';

    protected $fillable = [
        'modules_id', 'lang_id', 'name', 'body'
    ];

    public function modulesId(){
        return $this->hasOne('App\Models\ModulesId', 'id', 'modules_id');
    }

    public function modules_submenu(){
        return $this->hasMany('App\Models\ModulesSubmenu', 'modules_id', 'id');
    }

    public function modulesPermission()
    {
        return $this->hasMany('App\Models\AdminUserActionPermision', 'modules_id', 'id');
    }

    public function children(){
        return $this->HasMany('App\Models\ModulesId', 'p_id', 'modules_id');
    }

}
