<?php

namespace App\Navigation\PermissionGroup;

use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    protected $table = 'permission_groups';

    protected $fillable = [
        'id',
        'name',
        'level','group_code',
        'updated_at','created_at','deleted_at','updated_by','created_by','deleted_by'
    ];

    public function parent()
  	{
	    return $this->belongsTo('App\Navigation\PermissionGroup\PermissionGroup', 'parent_id');
	}

	public function children()
  	{
    	return $this->hasMany('App\Navigation\PermissionGroup\PermissionGroup', 'parent_id');
  	}

    
}
