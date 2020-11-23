<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandImages extends Model
{
    protected $table = 'brand_images';

    protected $fillable = [
        'brand_id', 'img', 'active', 'position'
    ];


}
