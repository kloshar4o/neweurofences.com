<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesWorks extends Model
{
    protected $table = 'services_works';

    protected $fillable = [
        'services_id', 'works_id'
    ];


}
