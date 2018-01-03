<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;

class Exam extends Model
{

    protected $table = 'exams';

    protected $fillable = [
        'name',
        'date',
        'arrive', 
        'start',
        'address',
        'canceled',
    ];

    /**
     * Get all of the seats for the exam.
     */
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function getArrive()
    {
        return date('H:i', strtotime($this->arrive));
    }

    public function getStart()
    {
        return date('H:i', strtotime($this->start));
    }

    public function getDate()
    {
    	$date = jdate($this->date)->format('%d %B %Y');
    	return $date;
    }
    
    /**
     * Get the number of exams in the system
     */
    public static function getCount()
    {
        return Exam::count();
    }

    /**
     * Get the number of seat filled for the exam
     */
    public static function getCancelCount( $exam_id )
    {
        $count = Exam::find($exam_id)->canceled;

        if ($count){
            return Exam::find($exam_id)->canceled;
        }else{
            return 0;
        }
    }

    public function schedules(){
        return $this->hasMany(Schedule::class);
    }
}
