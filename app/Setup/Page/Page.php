<?php

namespace App\Setup\Page;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'page';

    protected $fillable = [
        'id',
        'name',
        'content',
        'status',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
