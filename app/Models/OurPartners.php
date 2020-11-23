<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurPartners extends Model
{

    protected $table = 'our_partners';

    protected $fillable = [
        'our_partners_id', 'lang_id', 'img', 'name', 'body', 'link'
    ];

    public function partnersId()
    {
        return $this->hasOne('App\Models\OurPartnersId', 'id', 'our_partners_id');
    }

}
