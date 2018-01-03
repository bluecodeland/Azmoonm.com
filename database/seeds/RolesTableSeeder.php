<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name' => 'superuser', 'label' => 'کاربر ارشد', 'created_at' => date("Y-m-d H:i:s"), ]);
        DB::table('roles')->insert(['name' => 'admin', 'label' => 'مدیر سایت', 'created_at' => date("Y-m-d H:i:s"), ]);
        DB::table('roles')->insert(['name' => 'schooladmin', 'label' => 'مدیر مدرسه', 'created_at' => date("Y-m-d H:i:s"), ]);
        DB::table('roles')->insert(['name' => 'prospect', 'label' => 'داوطلب', 'created_at' => date("Y-m-d H:i:s"), ]);
        DB::table('roles')->insert(['name' => 'guest', 'label' => 'مهمان', 'created_at' => date("Y-m-d H:i:s"), ]);
    }
}
