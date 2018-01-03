<?php

use Illuminate\Database\Seeder;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exams')->insert([
            'name' => 'آزمون ورودی سال 95-96',
            'date' => '2016-05-21',
            'arrive' => '16:00',
            'start' => '16:30',
            'address' => 'قم - بلوار امین - بین کوچه ١٥-١٧ - مسجد المهدی',
            'canceled' => '0',
        ]);
    }
}
