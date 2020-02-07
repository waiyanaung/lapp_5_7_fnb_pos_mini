<?php

namespace App\Setup\Country;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'id',
        'name',
        'name_mm',
        'name_jp',
        'name_zh',
        'code',
        'status',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];
}
