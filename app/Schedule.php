<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;

use App\Schedule;

class Schedule extends Model
{

    protected $table = 'schedules';

    protected $fillable = [
        'exam_id',
        'type_id',
        'deadline', 
        'extension',
    ];

    public function type(){
		return $this->hasOne(Lookup::class, 'id');
	}

    public function exam(){
        return $this->belongTo(Exam::class);
    }

    public function getDeadline()
    {
        $date = getHindiNumerals(jdate($this->deadline)->format('%d %B %Y'));
        return $date;
    }

    public function getDeadline2()
    {
        $date = getHindiNumerals(jdate($this->deadline)->format('%d %B %Y H:i:s'));
        return $date;
    }

    public function getDeadlineDateTime()
    {
        $date = getHindiNumerals(jdate($this->deadline)->format('Y/m/d H:i:s'));
        return $date;
    }

    public static function getRegistrationStart( $exam_id )
    {
        $registration_start = Schedule::where('exam_id', $exam_id)
                            ->where('type_id', '1')
                            ->firstOrFail()->deadline;
        return $registration_start;
    }

    public static function getIranianRegistrationStart( $exam_id )
    {
        return jdate( Schedule::getRegistrationStart($exam_id) )->format('%d %B %Y');
    }

    public static function getRegistrationEnd( $exam_id )
    {
        $registration_deadline = Schedule::where('exam_id', $exam_id)
                            ->where('type_id', '2')
                            ->firstOrFail()->deadline;
        $registration_extension = Schedule::where('exam_id', $exam_id)
                            ->where('type_id', '2')
                            ->firstOrFail()->extension;

        if( $registration_extension <> '0000-00-00 00:00:00'){
            return $registration_extension;
        }
        return $registration_deadline;
    }

    public static function getIranianRegistrationEnd( $exam_id )
    {
        return jdate( Schedule::getRegistrationEnd($exam_id) )->format('%d %B %Y');
    }

    public static function getPrintCardDate( $exam_id )
    {
        $print_card_date = Schedule::where('exam_id', $exam_id)
                            ->where('type_id', '3')
                            ->firstOrFail()->deadline;
        return $print_card_date;
    }

    public static function getIranianPrintCardDate( $exam_id )
    {
        return jdate( Schedule::getPrintCardDate($exam_id) )->format('%d %B %Y ساعت H:i');
    }

    public static function getExamDate( $exam_id )
    {
        $exam_date = Schedule::where('exam_id', $exam_id)
                            ->where('type_id', '4')
                            ->firstOrFail()->deadline;
        return $exam_date;
    }

    public static function getIranianExamDate( $exam_id )
    {
        return jdate( Schedule::getExamDate($exam_id) )->format('%d %B %Y ساعت H:i');
    }

    public static function getResultsDate( $exam_id )
    {
        $results_date = Schedule::where('exam_id', $exam_id)
                            ->where('type_id', '5')
                            ->firstOrFail()->deadline;
        return $results_date;
    }

    public static function getIranianResultsDate( $exam_id )
    {
        return jdate( Schedule::getResultsDate($exam_id) )->format('%d %B %Y ساعت H:i');
    }

    public static function isRegistrationOpen( $exam_id )
    {
        $now = date("Y-m-d H:i:s");
        $registration_start = Schedule::getRegistrationStart( $exam_id );
        $registration_deadline = Schedule::getRegistrationEnd( $exam_id );

        if($now > $registration_start && $now < $registration_deadline){
            return 1;
        }
        return 0;
    }

    public static function isPrintCardOpen( $exam_id )
    {
        $now = date("Y-m-d H:i:s");
        $print_card_date = Schedule::getPrintCardDate( $exam_id );
        $exam_date = Schedule::getExamDate( $exam_id );

        if($now > $print_card_date && $now < $exam_date){
            return 1;
        }
        return 0;
    }

    public static function isViewResultsOpen( $exam_id )
    {
        $now = date("Y-m-d H:i:s");
        $results_date = Schedule::getResultsDate( $exam_id );

        if($now > $results_date){
            return 1;
        }
        return 0;
    }

}
