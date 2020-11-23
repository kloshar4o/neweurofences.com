<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class GallerySubject extends Model
{
    protected $table = 'gallery_subject';

    protected $fillable = [
        'gallery_subject_id', 'lang_id', 'name', 'body'
    ];

    public function gallerySubjectId(){
        return $this->hasOne('App\Models\GallerySubjectId', 'id', 'gallery_subject_id');
    }

    public function goodsOnePhoto() {
        return $this->hasOne('App\Models\GoodsPhoto', 'goods_item_id', 'goods_item_id')->where('active', '1')->orderBy('position', 'asc');
    }

    public function getOneItemPhoto(){
        return $this->hasOne('App\Models\GalleryItemId', 'gallery_subject_id', 'gallery_subject_id')->where('show_on_main', 1)->where('deleted', 0);
    }

}

