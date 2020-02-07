<?php
namespace App\Core\Role;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'core_roles';

    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at','updated_at','deleted_at'

    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
    /*
    public function permissions()
    {
        return $this->belongsTo('App\Core\Permission\Permission');
    }*/
}
