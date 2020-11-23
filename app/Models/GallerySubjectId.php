<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GallerySubjectId extends Model
{
    protected $table = 'gallery_subject_id';

    protected $fillable = [
        'p_id', 'alias', 'active', 'deleted', 'good_group', 'level', 'position','used'
    ];

    public function galleryItemId(){
        return $this->hasOne('App\Models\GalleryItemId', 'gallery_subject_id', 'id');
    }

}