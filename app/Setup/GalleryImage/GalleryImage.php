<?php

namespace App\Setup\GalleryImage;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $table = 'gallery_image';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'gallery_id',
        'image_url',
        'image_encode',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    
}
