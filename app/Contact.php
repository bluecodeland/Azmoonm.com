<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $table = 'contacts';

	protected $fillable = [
		'name',
		'subject',
		'email',
		'text',
		'parent_id',
	];

    public function getCreatedAtAttribute($value)
    {
      return jdate( $value )->format('H:i:s %d-%m-%Y');
    }
}
