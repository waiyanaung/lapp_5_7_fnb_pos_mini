<?php

namespace App\Setup\Transaction;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $primaryKey = 'id';

    public $incrementing = false;

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

    public function customer()
    {
        return $this->belongsTo('App\User','customer_id','id');
    }

    public function children()
    {
        return $this->hasMany('App\Setup\TransactionItem\TransactionItem','transaction_id','id');
    }

    public function payments()
    {
        return $this->hasMany('App\Setup\TransactionPayment\TransactionPayment','transaction_id','id');
    }


    
}
