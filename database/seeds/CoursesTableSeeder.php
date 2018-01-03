<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert(['name' => 'فقه و اصول', 'code' => '12345', 'start' => date("Y-m-d H:i:s"), 'end' => date("Y-m-d H:i:s"), ]);
    }
}