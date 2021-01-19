<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
	       'name' => 'Superadmin',
	       'email' => 'admin@mailinator.com',
	       'password' =>bcrypt('123456'),
          'role' => 1
	   ]);
    }
}
