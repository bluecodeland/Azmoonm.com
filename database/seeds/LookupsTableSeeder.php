<?php

use Illuminate\Database\Seeder;

class LookupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lookups')->insert([
            'id' => '1',
            'type' => 'registration_schedule',
            'name' => 'registration_start',
            'label' => 'شروع ثبت نام آزمون',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('lookups')->insert([
            'id' => '2',
            'type' => 'registration_schedule',
            'name' => 'registration_end',
            'label' => 'پایان ثبت نام و ویرایش',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('lookups')->insert([
            'id' => '3',
            'type' => 'registration_schedule',
            'name' => 'print_card_date',
            'label' => 'چاپ کارت ورود به جلسه',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('lookups')->insert([
            'id' => '4',
            'type' => 'registration_schedule',
            'name' => 'exam_date',
            'label' => 'روز برگزاری آزمون',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        DB::table('lookups')->insert([
            'id' => '5',
            'type' => 'registration_schedule',
            'name' => 'results_date',
            'label' => 'اعلام نتایج آزمون',
            'created_at' => date("Y-m-d H:i:s"),
        ]);

    }
}
