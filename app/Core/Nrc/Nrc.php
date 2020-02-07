<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 6/20/2016
 * Time: 3:56 PM
 */

namespace App\Core\Nrc;

use Illuminate\Database\Eloquent\Model;

class Nrc extends Model
{
    protected $table = 'nrc';

    protected $fillable = [
        'id',
        'user_id',
        'nrc_division',
        'nrc_national',
        'nrc_township1',
        'nrc_township2',
        'nrc_township3',
        'nrc_number',
        'updated_at','created_at','deleted_at'

    ];

}
