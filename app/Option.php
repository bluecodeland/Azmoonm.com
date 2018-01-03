<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'options';

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
    protected $fillable = ['type', 'name', 'label', 'description', 'value'];

    // public function formatTime($value)
    // {
    //     return date('H:i', strtotime($value));
    // }

    // public function formatDate($value)
    // {
    //     $date = jdate($value)->format('%d %B %Y');
    //     return $date;
    // }
}
