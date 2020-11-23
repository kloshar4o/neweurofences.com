<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasketId extends Model
{

    protected $table = 'basket_id';

    protected $fillable = [
        'id','user_ip'
    ];

	public function Basket() {
		return $this->hasOne('App\Models\Basket', 'id', 'basket_id');
	}
}
