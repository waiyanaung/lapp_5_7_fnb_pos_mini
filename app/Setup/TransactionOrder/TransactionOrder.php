<?php

namespace App\Setup\TransactionOrder;

use Illuminate\Database\Eloquent\Model;

class TransactionOrder extends Model
{
    protected $table = 'transaction_order';

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

    public function item()
    {
        return $this->belongsTo('App\Setup\Item\Item','item_id','id');
    }

    public function customer()
    {
        return $this->belongsTo('App\User','customer_id','id');
    }

    public function transaction()
    {
        return $this->belongsTo('App\Setup\Transaction\Transaction','transaction_id','id');
    }

    
}
