<?php

namespace App\Setup\Template;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'template';

    protected $fillable = [
        'id',
        'name',
        'description',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function slider()
    {
        return $this->hasMany('App\Setup\Slider\Slider');
    }
}
