<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'schools';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'label', 'admin_id', 'sort_order'];

    /**
     * The users that belong to the school.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('sort_order');
    }

    /**
     * The admin users that belong to the school.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
