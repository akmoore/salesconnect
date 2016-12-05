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
        // dd(config('services.admin'));
        DB::table('users')->insert([
        	'first_name' => 'Alfred',
        	'last_name' => 'Moore',
        	'slug' => 'alfred-moore',
        	'work_phone' => config('services.admin.work_phone'),
        	'cell_phone' => config('services.admin.cell_phone'),
        	'type' => 'admin',
        	'email' => config('services.admin.user'),
        	'password' => bcrypt(config('services.admin.password')),
        	'created_at' => Carbon\Carbon::now(),
        	'updated_at' => Carbon\Carbon::now()
        ]);
    }
}