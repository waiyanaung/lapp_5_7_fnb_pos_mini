<?php

namespace App\Setup\Checklistquestion;

use Illuminate\Database\Eloquent\Model;

class Checklistquestion extends Model
{
    protected $table = 'checklistquestions';

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
