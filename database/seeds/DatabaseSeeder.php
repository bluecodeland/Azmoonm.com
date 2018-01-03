<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    Model::unguard();

        $this->call(LookupsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);

        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(ExamsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);        

        $this->call(CoursesTableSeeder::class);

        $this->call(SchoolsTableSeeder::class);
        
        // $this->call(FactorySeeder::class);

	    Model::reguard();
    }
}