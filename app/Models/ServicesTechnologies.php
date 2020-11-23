<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesTechnologies extends Model
{
    protected $table = 'services_technologies';

    protected $fillable = [
        'services_id', 'technologies_id'
    ];


}
