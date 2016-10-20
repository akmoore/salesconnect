<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'first_name' => 'Alfred',
        	'last_name' => 'Moore',
        	'slug' => 'alfred-moore',
        	'work_phone' => '(225) 288-9870',
        	'cell_phone' => '(225) 928-4142',
        	'type' => 'admin',
        	'email' => 'ak_moore@live.com',
        	'password' => bcrypt('password'),
        	'created_at' => Carbon\Carbon::now(),
        	'updated_at' => Carbon\Carbon::now()
        ]);
    }
}