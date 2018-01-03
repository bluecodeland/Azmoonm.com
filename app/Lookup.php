<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lookup extends Model
{

    protected $table = 'lookups';

    protected $fillable = [
        'type',
        'name',
        'label', 
    ];

    public function schedules(){
		return $this->hasMany(Schedule::class);
	}

}
