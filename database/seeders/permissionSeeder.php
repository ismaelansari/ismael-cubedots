<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class permissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = array('Show','Create','Update','Delete');
        $module = array('1','2');
    	foreach ($module as $key => $m) {
    		foreach ($permissions as $key => $p) {
	    		DB::table('permissions')->insert([
			       'permission_name' => "$p",
			       'module_id' => "$m"
			   ]);
	    	}
    	}
    	
    }
}
