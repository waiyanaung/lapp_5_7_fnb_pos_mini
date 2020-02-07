<?php

namespace App\Setup\Township;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    protected $table = 'townships';

    protected $fillable = [
        'id',
        'name',
        'name_mm',
        'name_jp',
        'name_zh',
        'city_id',
        'code',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    public function city()
    {
        return $this->belongsTo('App\Setup\City\City','city_id','id');
    }
}
