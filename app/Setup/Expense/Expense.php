<?php

namespace App\Setup\Expense;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expenses';

    protected $fillable = [
        'id',
        'name',
        'name_mm',
        'name_jp',
        'name_zh',
        'country_id',
        'code',
        'image_url',
        'hidden_display',
        'inverter_type',
        'brand_id',
        'country_id',
        'expense_horse_power_id',
        'expense_cooling_capacity_id',
        'expense_air_flow_type_id',
        'expense_refrigerant_type_id',
        'expense_swing_type_id',
        'what_is_inbox',
        'outdoor_unit',
        'indoor_unit',
        'custom_features',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    
}
