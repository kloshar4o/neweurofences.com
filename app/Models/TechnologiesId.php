<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnologiesId extends Model
{
    protected $table = 'technologies_id';

    protected $fillable = [
        'alias', 'position', 'active', 'deleted'
    ];

    public function technologies() {
        return $this->hasMany('App\Models\TechnologiesId', 'id', 'technologies_id');
    }

    public function moduleMultipleImg() {
        return $this->hasMany('App\Models\TechnologiesImages', 'technologies_id', 'id')->orderBy('position', 'asc');
    }
}
