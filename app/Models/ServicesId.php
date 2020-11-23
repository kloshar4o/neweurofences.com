<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesId extends Model
{
    protected $table = 'services_id';

    protected $fillable = [
        'alias', 'position', 'active', 'deleted'
    ];

    public function services() {
        return $this->hasMany('App\Models\ServicesId', 'id', 'services_id');
    }

    public function moduleMultipleImg() {
        return $this->hasMany('App\Models\ServicesImages', 'services_id', 'id')->orderBy('position', 'asc');
    }

    public function servicesTechnologies()
    {
        return $this->hasMany('App\Models\ServicesTechnologies', 'services_id', 'id');
    }

    public function servicesWorks()
    {
        return $this->hasMany('App\Models\ServicesWorks', 'services_id', 'id');
    }
}
