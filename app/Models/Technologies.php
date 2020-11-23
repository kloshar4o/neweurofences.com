<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technologies extends Model
{
    protected $table = 'technologies';

    protected $fillable = [
        'technologies_id', 'lang_id', 'name', 'descr', 'body', 'page_title', 'h1_title', 'meta_title', 'meta_keywords', 'meta_description'
    ];

    public function technologiesId() {
        return $this->hasOne('App\Models\TechnologiesId', 'id', 'technologies_id');
    }
}
