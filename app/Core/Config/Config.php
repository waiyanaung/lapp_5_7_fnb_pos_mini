<?php

namespace App\Core\Config;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'core_configs';

    protected $fillable = [
        'code',
        'type',
        'description',
        'description'

    ];


}
