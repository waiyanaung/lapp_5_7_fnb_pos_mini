<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    protected $table = 'sample';

    protected $fillable = [
        'id',
        'name',
        'description',
        'name',
        'status',
        'updated_at','created_at','deleted_at'
        ,
    ];
}
