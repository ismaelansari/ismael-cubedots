<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = array('Roles','Post');
    	foreach ($module as $key => $m) {
    		DB::table('modules')->insert([
		       'module_name' => "$m",
		       'is_status' => "1"
		   ]);
    	}
    }
}
