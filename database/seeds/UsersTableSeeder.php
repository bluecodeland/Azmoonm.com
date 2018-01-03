<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'firstname' => 'محسن رضا',
            'lastname' => 'شاه',
            'mobile' => '09336382634',
            'email' => 'mohsin.shah@cloudmsd.com',
            'password' => bcrypt(generatePassword()),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $user->assign('superuser');

        $user = User::create([
            'firstname' => 'محمد حسین',
            'lastname' => 'طائب',
            'mobile' => '09352572809',
            'email' => 'mhtaeb@gmail.com',
            'password' => bcrypt(generatePassword()),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $user->assign('superuser');

        $user = User::create([
            'firstname' => 'مهدی',
            'lastname' => 'طائب',
            'mobile' => '09396763348',
            'email' => 'mahdi.taeb@gmail.com',
            'password' => bcrypt(generatePassword()),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $user->assign('admin');

        $user = User::create([
            'firstname' => 'محمد',
            'lastname' => 'پیروی',
            'mobile' => '09196645294',
            'email' => '61sina61@gmail.com',
            'password' => bcrypt(generatePassword()),
            'created_at' => date("Y-m-d H:i:s"),
        ]);
        $user->assign('admin');

    }
}