<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurPartnersId extends Model
{

    protected $table = 'our_partners_id';

    protected $fillable = [
        'position', 'active', 'deleted'
    ];
}
