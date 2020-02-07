<?php

namespace App\Setup\City;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'id',
        'name',
        'name_mm',
        'name_jp',
        'name_zh',
        'country_id',
        'code',
        'image_url',
        'detail_info',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    public function country()
    {
        return $this->belongsTo('App\Setup\Country\Country','country_id','id');
    }

    
}
