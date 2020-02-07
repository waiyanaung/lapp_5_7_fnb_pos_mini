<?php

namespace App\Setup\Service;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'id',
        'price',
        'name',
        'name_mm',
        'name_jp',
        'name_zh',
        'code',
        'image_url',
        'description',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    
}
