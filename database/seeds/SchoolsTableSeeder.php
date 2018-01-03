<?php

use Illuminate\Database\Seeder;
use App\User;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'firstname' => 'abc',
            'lastname' => 'abc',
            'mobile' => '09191112222',
            'email' => '09191112222@abc.com',
            'password' => bcrypt(generatePassword()),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $user->assign('schooladmin');
        DB::table('schools')->insert([
            'name' => 'مرکز فقهی قائم (عج)', 
            'label' => 'قائم', 
            'admin_id' => $user->id, 
            'created_at' => date("Y-m-d H:i:s"), 
        ]);

        $user = User::create([
            'firstname' => 'bcd',
            'lastname' => 'bcd',
            'mobile' => '09191113333',
            'email' => '09191113333@bcd.com',
            'password' => bcrypt(generatePassword()),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $user->assign('schooladmin');
        DB::table('schools')->insert([
            'name' => 'مدرسه علمیه امام حسن عسگری (ع)', 
            'label' => 'حسن عسگری', 
            'admin_id' => $user->id, 
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        $user = User::create([
            'firstname' => 'cde',
            'lastname' => 'cde',
            'mobile' => '09191114444',
            'email' => '09191114444@cde.com',
            'password' => bcrypt(generatePassword()),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $user->assign('schooladmin');
        DB::table('schools')->insert([
            'name' => 'مدرسه علمیه حضرت صاحب الامر (عج)', 
            'label' => 'صاحب الامر', 
            'admin_id' => $user->id, 
            'created_at' => date("Y-m-d H:i:s"), 
        ]);

        $user = User::create([
            'firstname' => 'def',
            'lastname' => 'def',
            'mobile' => '09191115555',
            'email' => '09191115555@def.com',
            'password' => bcrypt(generatePassword()),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $user->assign('schooladmin');
        DB::table('schools')->insert([
            'name' => 'مدرسه عالی کریم اهل بیت', 
            'label' => 'کریم اهل بیت', 
            'admin_id' => $user->id, 
            'created_at' => date("Y-m-d H:i:s"), 
        ]);

        $user = User::create([
            'firstname' => 'efg',
            'lastname' => 'efg',
            'mobile' => '09191116666',
            'email' => '09191116666@efg.com',
            'password' => bcrypt(generatePassword()),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $user->assign('schooladmin');
        DB::table('schools')->insert([
            'name' => 'مدرسه فقهی آل یاسین', 
            'label' => 'آل یاسین', 
            'admin_id' => $user->id, 
            'created_at' => date("Y-m-d H:i:s"), 
        ]);

        $user = User::create([
            'firstname' => 'fgh',
            'lastname' => 'fgh',
            'mobile' => '09191117777',
            'email' => '09191117777@fgh.com',
            'password' => bcrypt(generatePassword()),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $user->assign('schooladmin');
        DB::table('schools')->insert([
            'name' => 'مدرسه علمیه امام کاظم (ع)', 
            'label' => 'امام کاظم', 
            'admin_id' => $user->id, 
            'created_at' => date("Y-m-d H:i:s"), 
        ]);

    }
}
