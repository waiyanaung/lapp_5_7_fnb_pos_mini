<?php

namespace App\Setup\TransactionItemTemp;

use Illuminate\Database\Eloquent\Model;

class TransactionItemTemp extends Model
{
    protected $table = 'transaction_item_temp';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'customer_id',
        'date',
        'add_installation',
        'total_item_qty',
        'item_id',
        'item_price',
        'total_item_price',
        'discount_type',
        'discounts',
        'grand_total',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    
}
