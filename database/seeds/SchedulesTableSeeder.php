<?php

use Illuminate\Database\Seeder;
use App\Schedule;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create(["month" => "January"]);
        Schedule::create(["month" => "February"]);
        Schedule::create(["month" => "March"]);
        Schedule::create(["month" => "April"]);
        Schedule::create(["month" => "May"]);
        Schedule::create(["month" => "June"]);
        Schedule::create(["month" => "July"]);
        Schedule::create(["month" => "August"]);
        Schedule::create(["month" => "September"]);
        Schedule::create(["month" => "October"]);
        Schedule::create(["month" => "November"]);
        Schedule::create(["month" => "December"]);
    }
}
