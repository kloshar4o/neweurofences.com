<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'services_id', 'lang_id', 'name', 'descr', 'body', 'page_title', 'h1_title', 'meta_title', 'meta_keywords', 'meta_description'
    ];

    public function servicesId() {
        return $this->hasOne('App\Models\ServicesId', 'id', 'services_id');
    }
}
