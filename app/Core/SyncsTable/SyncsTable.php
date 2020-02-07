<?php

namespace App\Core\SyncsTable;

use Illuminate\Database\Eloquent\Model;

class SyncsTable extends Model
{
    protected $table = 'core_syncs_tables';

    protected $fillable = [
        'id',
        'table_name',
        'version',
        'active'
    ];

}
