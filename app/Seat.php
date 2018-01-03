<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Seat extends Model
{


    protected $table = 'seats';

    protected $fillable = [
        'seat_number',
    ];

    /**
     * Get the exam for the seat.
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Get the exam for the seat.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    /**
     * Get the next available seat.
     */
    public static function getAvailableSeat()
    {
        $seat = DB::select('
            SELECT t1.seat_number+1 AS empty_seat 
            FROM seats AS t1 
            LEFT JOIN seats AS t2 
                ON t1.seat_number+1 = t2.seat_number 
            WHERE t2.seat_number IS NULL 
            ORDER BY t1.seat_number 
            LIMIT 1;');

        if($seat){
            return $seat[0]->empty_seat;
        }else{
            return 1;
        }
    }

    /**
     * Get the number of seat filled for the exam
     */
    public static function getCount( $exam_id )
    {
        return Seat::where('exam_id', $exam_id)->count();
    }

}
