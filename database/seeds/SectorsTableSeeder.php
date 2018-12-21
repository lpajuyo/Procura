<?php

use Illuminate\Database\Seeder;
use App\Sector;

class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sector::create(["name" => "Office of the President"]);
        Sector::create(["name" => "Academic Affairs"]);
        Sector::create(["name" => "Administration and Finance"]);
        Sector::create(["name" => "Research and Extension"]);
        Sector::create(["name" => "Planning Development and Information System"]);
    }
}
