<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="core_users";
    protected $fillable = [
        'id',
        'user_name',
        'email',
        'display_name',
        'display_name_mm',
        'display_name_jp',
        'display_name_zh',
        'password',
        'role_id',
        'status',
        'updated_at','created_at','deleted_at'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getObjByID(){
        return $this->id;
    }
    public function role()
    {
        return $this->belongsTo('App\Core\Role\Role','role_id','id');
    }
    public function session(){
        return $this->hasMany('App\Session\Session');
    }
}
