<?php

namespace App\Setup\Expense;

use Illuminate\Database\Eloquent\Model;
use App\Setup\ExpenseType\ExpenseType;

class Expense extends Model
{
    protected $table = 'expenses';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
        ,
    ];

    public function type()
    {
        return $this->belongsTo('App\Setup\ExpenseType\ExpenseType','expense_type_id','id');
    }
}
