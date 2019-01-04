<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "user_type_id" => "1",
            "username" => "depthead",
            "name" => "Department Head",
            "password" => Hash::make('1234'),
        ]);
        User::create([
            "user_type_id" => "2",
            "username" => "budgetofficer",
            "name" => "Budget Officer",
            "password" => Hash::make('1234'),
        ]);
        User::create([
            "user_type_id" => "3",
            "username" => "sectorhead",
            "name" => "Sector Head",
            "password" => Hash::make('1234'),
        ]);
    }
}
