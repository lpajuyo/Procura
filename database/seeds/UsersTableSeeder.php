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
            "position" => "Administrator",
            "password" => Hash::make('1234'),
        ]);
        User::create([
            "user_type_id" => "1",
            "username" => "depthead",
            "name" => "Department Head",
            "position" => "Head, Bids and Awards Committee Office",
            "password" => Hash::make('1234'),
            "userable_id" => 1,
            "userable_type" => "App\DepartmentHead",
            "user_signature" => "user_signatures/HIW06gCVIj5Xo34OxeknAaI6H0CdMBIAePTtg9Ze.png",
        ]);
        User::create([
            "user_type_id" => "1",
            "username" => "depthead2",
            "name" => "Department Head2",
            "position" => "Head, Mathematics Department",
            "password" => Hash::make('1234'),
            "userable_id" => 2,
            "userable_type" => "App\DepartmentHead",
        ]);
        User::create([
            "user_type_id" => "1",
            "username" => "depthead3",
            "name" => "Department Head3",
            "position" => "Head, Physics Department",
            "password" => Hash::make('1234'),
            "userable_id" => 3,
            "userable_type" => "App\DepartmentHead",
        ]);
        User::create([
            "user_type_id" => "2",
            "username" => "budgetofficer",
            "name" => "Budget Officer",
            "position" => "Budget Officer",
            "password" => Hash::make('1234'),
        ]);
        User::create([
            "user_type_id" => "3",
            "username" => "sectorhead",
            "name" => "Sector Head",
            "position" => "President",
            "password" => Hash::make('1234'),
            "userable_id" => 1,
            "userable_type" => "App\SectorHead",
            "user_signature" => "user_signatures/ZATrht6ZH11LvZbfDjirpERCodsnZK6DbuVhYHXm.png",
        ]);
        User::create([
            "user_type_id" => "3",
            "username" => "sectorhead2",
            "name" => "Sector Head2",
            "position" => "Vice President for Academic Affairs",
            "password" => Hash::make('1234'),
            "userable_id" => 2,
            "userable_type" => "App\SectorHead",
        ]);
        User::create([
            "user_type_id" => "3",
            "username" => "sectorhead3",
            "name" => "Sector Head3",
            "position" => "Vice President for Administration and Finance",
            "password" => Hash::make('1234'),
            "userable_id" => 3,
            "userable_type" => "App\SectorHead",
        ]);
        User::create([
            "user_type_id" => "5",
            "username" => "bacsecretariat",
            "name" => "BAC Secretariat",
            "position" => "BAC Secretariat",
            "password" => Hash::make('1234'),
        ]);
    }
}
