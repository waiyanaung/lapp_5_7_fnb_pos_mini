<?php

namespace App\Setup\Item;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

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
        'item_horse_power_id',
        'item_cooling_capacity_id',
        'item_air_flow_type_id',
        'item_refrigerant_type_id',
        'item_swing_type_id',
        'what_is_inbox',
        'outdoor_unit',
        'indoor_unit',
        'custom_features',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    
}
