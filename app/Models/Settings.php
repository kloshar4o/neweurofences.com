<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Settings extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'settings_id', 'lang_id', 'name', 'body'
    ];

    public function settingsId()
    {
        return $this->hasOne('App\Models\SettingsId', 'id', 'settings_id');
    }
}