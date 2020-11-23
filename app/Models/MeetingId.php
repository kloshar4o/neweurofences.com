<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingId extends Model
{

    protected $table = 'meeting_id';

    protected $fillable = [
        'admin_user_id', 'seen', 'add_date', 'reminder'
    ];

    public function meetingUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'admin_user_id');
    }

}
