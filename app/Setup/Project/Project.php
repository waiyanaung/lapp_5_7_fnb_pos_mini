<?php

namespace App\Setup\Project;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'documents';

    protected $fillable = [
        'id',
        'name',
        'name_mm',
        'name_jp',
        'name_zh',
        'code',
        'image',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    
}
