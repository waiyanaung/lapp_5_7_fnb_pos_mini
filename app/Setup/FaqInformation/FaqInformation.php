<?php

namespace App\Setup\FaqInformation;

use Illuminate\Database\Eloquent\Model;

class FaqInformation extends Model
{
    protected $table = 'faq_informations';

    protected $fillable = [
        'id',
        'name',
        'image_url',
        'detail_info',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    
}
