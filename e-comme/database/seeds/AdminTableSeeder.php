<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* Insert Data Into admins table */
        DB::table('admins')->insert([
            'name'     => 'Admin',
            'phone'     => '01005042565',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('07070707'),
        ]);

    }
}
