<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnologiesImages extends Model
{
    protected $table = 'technologies_images';

    protected $fillable = [
        'technologies_id', 'img', 'active', 'position'
    ];

}
