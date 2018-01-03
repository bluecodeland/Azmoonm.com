<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{


    protected $table = 'roles';

    protected $fillable = [
        'name',
        'label',
    ];

    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * Get all of the permissions for the role.
     */
    public function permissions()
    {
    	return $this->belongsToMany(Permission::class);
    }

    /**
     * Assign permission or permissions to the role.
     */
    public function assign(Permission $permission)
    {
    	return $this->permissions()->save($permission);
    }

}
