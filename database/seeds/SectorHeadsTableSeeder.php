<?php

use Illuminate\Database\Seeder;
use App\SectorHead;

class SectorHeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SectorHead::create(["sector_id" => 1]);
        SectorHead::create(["sector_id" => 2]);
        SectorHead::create(["sector_id" => 3]);
    }
}
