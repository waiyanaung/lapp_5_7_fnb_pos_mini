<?php

namespace App\Setup\CoreSettings;

use Illuminate\Database\Eloquent\Model;

class Coresettings extends Model
{
    protected $table = 'core_settings';

    protected $fillable = [
        'code',
        'type',
        'value',
        'description',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];
}
