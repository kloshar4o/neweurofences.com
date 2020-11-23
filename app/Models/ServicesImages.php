<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesImages extends Model
{
    protected $table = 'services_images';

    protected $fillable = [
        'services_id', 'img', 'active', 'position'
    ];


}
