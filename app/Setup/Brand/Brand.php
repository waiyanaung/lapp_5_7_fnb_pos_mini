<?php

namespace App\Setup\Brand;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';

    protected $fillable = [
        'id',
        'name',
        'code',
        'status',
        'model',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];
}
