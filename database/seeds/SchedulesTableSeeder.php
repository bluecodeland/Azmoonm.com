<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //start of registration process
        DB::table('schedules')->insert([
            'exam_id' => '1',
            'type_id' => '1',
            'deadline' => '2017-04-07 00:00:00',
            'extension' => '0000-00-00 00:00:00',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        //end of registration process
        DB::table('schedules')->insert([
            'exam_id' => '1',
            'type_id' => '2',
            'deadline' => '2017-04-24 23:59:59',
            'extension' => '0000-00-00 00:00:00',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        //start of printing id badges
        DB::table('schedules')->insert([
            'exam_id' => '1',
            'type_id' => '3',
            'deadline' => '2017-04-26 00:00:00',
            'extension' => '0000-00-00 00:00:00',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        //date of exam
        DB::table('schedules')->insert([
            'exam_id' => '1',
            'type_id' => '4',
            'deadline' => '2017-04-28 16:00:00',
            'extension' => '0000-00-00 00:00:00',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        //date of results
        DB::table('schedules')->insert([
            'exam_id' => '1',
            'type_id' => '5',
            'deadline' => '2017-04-30 16:00:00',
            'extension' => '0000-00-00 00:00:00',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

    }
}