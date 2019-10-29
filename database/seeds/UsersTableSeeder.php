<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Eloquent\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $jw = User::create([
			'first_name' => 'Joshua',
			'last_name' => 'Wieczorek',
			'email' => 'joshuawieczorek@outlook.com',
			'phone' => '561-332-5055',
			'password' => Hash::make('Pa$$word1'),
		    'status' => 1
	    ]);

	    $ed = User::create([
		    'first_name' => 'Edmund',
		    'last_name' => 'DeSoto',
		    'email' => 'shoutofvictory@me.com',
		    'phone' => '561-346-4495',
		    'password' => Hash::make('Pa$$word1'),
		    'status' => 1
	    ]);

	    $jw->roles()->sync([1]);
	    $ed->roles()->sync([1]);
    }
}
