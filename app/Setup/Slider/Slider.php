<?php

namespace App\Setup\Slider;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = [
        'id',
        'image_url',
        'defatult_image',
        'template_name',
        'status',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function template()
    {
        return $this->belongsTo('App\Setup\Template\Template','template_id','id');
    }
}
