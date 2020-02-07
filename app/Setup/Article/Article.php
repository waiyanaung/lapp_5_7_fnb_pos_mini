<?php

namespace App\Setup\Article;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'id',
        'name',
        'name_mm',
        'name_jp',
        'name_zh',
        'country_id',
        'code',
        'image',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    
}
