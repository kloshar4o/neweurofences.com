<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionsImages extends Model
{
    protected $table = 'promotions_images';

    protected $fillable = [
        'promotions_id', 'img', 'active', 'position'
    ];


}
