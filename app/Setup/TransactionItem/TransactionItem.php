<?php

namespace App\Setup\TransactionItem;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $table = 'transaction_item';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'transaction_id',
        'status',
        'item_id',
        'date',
        'item_qty',
        'item_price',
        'item_amt',
        'discount_type',
        'discount_percent',
        'discount_amt',
        'sub_total_amt',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    public function item()
    {
        return $this->belongsTo('App\Setup\Item\Item','item_id','id');
    }


    public function category()
    {
        return $this->belongsTo('App\Setup\Category\Category','category_id','id');
    }

    public function brand()
    {
        return $this->belongsTo('App\Setup\Brand\Brand','brand_id','id');
    }

    
}
