<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{

    protected $table = 'meeting';

    protected $fillable = [
        'meeting_id', 'lang_id', 'name', 'body'
    ];

    public function meetingId()
    {
        return $this->hasOne('App\Models\MeetingId', 'id', 'meeting_id');
    }
}
