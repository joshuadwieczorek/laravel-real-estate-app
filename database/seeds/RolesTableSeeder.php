<?php

use Illuminate\Database\Seeder;
use App\Eloquent\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
			'name' => 'Super Admin',
        ]);

	    Role::create([
		    'name' => 'Admin',
	    ]);

	    Role::create([
		    'name' => 'Agent'
	    ]);

	    Role::create([
		    'name' => 'Visitor',
	    ]);
    }
}
