<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Application extends Model
{

  protected $table = 'applications';

  protected $fillable = [
  'user_id',
  'application_reference',
  'fathers_name',
  'national_code',
  'id_number',
  'birth_date',
  'birth_place',
  'place_of_issue',
  'marital_status',
  'children',
  'landline',
  'postcode',
  'state',
  'city',
  'address',
  'employment_status',
  'place_of_work',
  'level_1_grade',
  'level_2_grade',
  'level_3_grade',
  'level_4_grade',
  'level_5_grade',
  'current_school',
  'picture',
  ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public static function getIranianDate( $date )
    {
        // return jdate( $date )->format('%d %B %Y ساعت H:i');
      return $date ;
    }

    public static function getMaritalStatus( $marital_status )
    {
      if($marital_status == 1){
        return 'متاهل';
      }
      return 'مجرد';
    }

    public static function getEmploymentStatus( $employment_status )
    {
      if($employment_status == 1){
        return 'شاغل';
      }
      return 'غیر شاغل';
    }
    /**
     * Get and set place_of_work to Hindi format
     */
    public function getPlaceOfWorkAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setPlaceOfWorkAttribute($value)
    {
        $this->attributes['place_of_work'] = getHindiNumerals($value);
    }

    public function getCreatedAtAttribute($value)
    {
      return jdate( $value )->format('%d-%m-%Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
      return jdate( $value )->format('H:i:s %d-%m-%Y');
    }

    public function getPrintedCardAtAttribute($value)
    {
      if($value != '0000-00-00 00:00:00')
      {
        return jdate( $value )->format('H:i:s %d-%m-%Y');
      }else{
        return '00-00-00 00-00-0000';
      }
    }

    public function getPrintedCardAtYear()
    {
      if($this->printed_card_at != '00-00-00 00-00-0000')
      {
        return jdate( $this->printed_card_at )->format('%Y');
      }else{
        return '0000';
      }
    }

    /**
     * Get and set national_code to Hindi format
     */
    public function getNationalCodeAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setNationalCodeAttribute($value)
    {
        $this->attributes['national_code'] = getHindiNumerals($value);
    }

    /**
     * Get and set id_number to Hindi format
     */
    public function getIdNumberAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setIdNumberAttribute($value)
    {
        $this->attributes['id_number'] = getHindiNumerals($value);
    }

    /**
     * Get and set birth_date to Hindi format
     */
    public function getBirthDateAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setBirthDateAttribute($value)
    {
        $this->attributes['birth_date'] = getHindiNumerals($value);
    }

    /**
     * Get and set children to Hindi format
     */
    public function getChildrenAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setChildrenAttribute($value)
    {
        $this->attributes['children'] = getHindiNumerals($value);
    }

    /**
     * Get and set landline to Hindi format
     */
    public function getLandlineAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setLandlineAttribute($value)
    {
        $this->attributes['landline'] = getHindiNumerals($value);
    }

    /**
     * Get and set address to Hindi format
     */
    public function getAddressAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = getHindiNumerals($value);
    }

    /**
     * Get and set place_of_work to Hindi format
     */
    public function getplace_of_workAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setplace_of_workAttribute($value)
    {
        $this->attributes['place_of_work'] = getHindiNumerals($value);
    }

    /**
     * Get and set level_1_grade to Hindi format
     */
    public function getLevel1GradeAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setLevel1GradeAttribute($value)
    {
        $this->attributes['level_1_grade'] = getHindiNumerals($value);
    }

    /**
     * Get and set level_2_grade to Hindi format
     */
    public function getLevel2GradeAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setLevel2GradeAttribute($value)
    {
        $this->attributes['level_2_grade'] = getHindiNumerals($value);
    }

    /**
     * Get and set level_3_grade to Hindi format
     */
    public function getLevel3GradeAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setLevel3GradeAttribute($value)
    {
        $this->attributes['level_3_grade'] = getHindiNumerals($value);
    }

    /**
     * Get and set level_4_grade to Hindi format
     */
    public function getLevel4GradeAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setLevel4GradeAttribute($value)
    {
        $this->attributes['level_4_grade'] = getHindiNumerals($value);
    }

    /**
     * Get and set level_5_grade to Hindi format
     */
    public function getLevel5GradeAttribute($value)
    {
        return getHindiNumerals($value);
    }
    public function setLevel5GradeAttribute($value)
    {
        $this->attributes['level_5_grade'] = getHindiNumerals($value);
    }


  }
