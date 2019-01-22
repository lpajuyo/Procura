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
            "user_type_id" => "4",
            "username" => "admin",
            "name" => "Administrator",
            "password" => Hash::make('1234'),
        ]);
        User::create([
            "user_type_id" => "1",
            "username" => "depthead",
            "name" => "Department Head",
            "password" => Hash::make('1234'),
            "userable_id" => 1,
            "userable_type" => "App\DepartmentHead",
        ]);
        User::create([
            "user_type_id" => "1",
            "username" => "depthead2",
            "name" => "Department Head2",
            "password" => Hash::make('1234'),
            "userable_id" => 2,
            "userable_type" => "App\DepartmentHead",
        ]);
        User::create([
            "user_type_id" => "1",
            "username" => "depthead3",
            "name" => "Department Head3",
            "password" => Hash::make('1234'),
            "userable_id" => 3,
            "userable_type" => "App\DepartmentHead",
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
            "userable_id" => 1,
            "userable_type" => "App\SectorHead",
        ]);
        User::create([
            "user_type_id" => "3",
            "username" => "sectorhead2",
            "name" => "Sector Head2",
            "password" => Hash::make('1234'),
            "userable_id" => 2,
            "userable_type" => "App\SectorHead",
        ]);
        User::create([
            "user_type_id" => "3",
            "username" => "sectorhead3",
            "name" => "Sector Head3",
            "password" => Hash::make('1234'),
            "userable_id" => 3,
            "userable_type" => "App\SectorHead",
        ]);
    }
}
