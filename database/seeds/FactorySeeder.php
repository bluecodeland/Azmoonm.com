<?php

use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        for($i = 0; $i < 145; $i++) {
            $dt = $faker->dateTimeBetween($startDate = '-1 week', $endDate = '+1 week');
            $date = $dt->format("Y-m-d H:i:s"); 
            $mobile =  '0' . $faker->biasedNumberBetween($min = 9330000000, $max = 9359999999, $function = 'sqrt');
            $user = App\User::create([
                'firstname' => $faker->firstname,
                'lastname' => $faker->lastname,
                'mobile' => $mobile,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt(str_random(10)),
                'created_at' => $date,
            ]);
            $user->assign('prospect');
            $application = App\Application::create([
                'user_id' => $user->id,
                'application_reference' => $faker->unique()->biasedNumberBetween($min = 100000, $max = 999999, $function = 'sqrt'),
                'created_at' => $date,
                'updated_at' => $date,
            ]);


	        $user->schools()->attach('1', ['sort_order' => '1' ]);
	        $school_id = $faker->biasedNumberBetween($min = 2, $max = 3, $function = 'sqrt');
	        $user->schools()->attach($school_id, ['sort_order' => '2' ]);
	        $school_id = $faker->biasedNumberBetween($min = 4, $max = 5, $function = 'sqrt');
	        $user->schools()->attach($school_id, ['sort_order' => '3' ]);

        }

    }
}
