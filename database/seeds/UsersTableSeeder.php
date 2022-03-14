<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_name' => 'gco_admin',
            'name' => 'GCO ADMIN',
            'image' => '/public/backend/images/avatar_default.png',
            'email' => 'dangthanh151293@gmail.com',
            'password' => Hash::make('gco@2021'),
            'status' => 1, 
            'level' => 1,
        ]);
    }
}
