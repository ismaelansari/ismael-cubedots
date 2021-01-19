<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = array('Superadmin','Editor','Reader');
    	foreach ($roles as $key => $r) {
    		DB::table('roles')->insert([
		       'name' => "$r",
		       'description' => "$r Admin Roles"
		   ]);
    	}
         
    }
}
