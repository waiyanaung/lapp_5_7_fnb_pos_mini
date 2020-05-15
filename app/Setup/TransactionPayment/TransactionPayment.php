<?php

namespace App\Setup\TransactionPayment;

use Illuminate\Database\Eloquent\Model;

class TransactionPayment extends Model
{
    protected $table = 'transaction_payment';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'transaction_id',
        'status',
        'date',
        'payment_type',
        'paid_amt',
        'change_amt',
        'remark',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    public function parent()
    {
        return $this->belongsTo('App\Setup\Transaction\Transaction','transaction_id','id');
    }
    
}
