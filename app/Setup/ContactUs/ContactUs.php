<?php

namespace App\Setup\ContactUs;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'detail_info',
        'remark',
        'status',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    
}
