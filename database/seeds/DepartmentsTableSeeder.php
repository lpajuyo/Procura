<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Office of the President
        Department::create(["sector_id" => "1", "name" => "Bids and Awards Committee Office"]);

        //Academic Affairs
        Department::create(["sector_id" => "2", "name" => "Mathematics Department"]);
        Department::create(["sector_id" => "2", "name" => "Physics Department"]);
        Department::create(["sector_id" => "2", "name" => "Chemistry Department"]);
        Department::create(["sector_id" => "2", "name" => "CHED Department"]);
        Department::create(["sector_id" => "2", "name" => "Social Science Department"]);
        Department::create(["sector_id" => "2", "name" => "English Department"]);
        Department::create(["sector_id" => "2", "name" => "Filipino Department"]);
        Department::create(["sector_id" => "2", "name" => "Mechanical Engineering Department"]);
        Department::create(["sector_id" => "2", "name" => "Physical Education Department"]);
        Department::create(["sector_id" => "2", "name" => "Student Teaching Department"]);
        Department::create(["sector_id" => "2", "name" => "Technical Arts Department"]);
        Department::create(["sector_id" => "2", "name" => "Home Economics Department"]);
        Department::create(["sector_id" => "2", "name" => "Graphics Department"]);
        Department::create(["sector_id" => "2", "name" => "Architecture Department"]);
        Department::create(["sector_id" => "2", "name" => "Fine Arts Department"]);
        Department::create(["sector_id" => "2", "name" => "Basic Industrial Education Department"]);
        Department::create(["sector_id" => "2", "name" => "Professional Industrial Education Department"]);
        Department::create(["sector_id" => "2", "name" => "Civil Engineering Department"]);
        Department::create(["sector_id" => "2", "name" => "Power Plant Engineering Department"]);
        Department::create(["sector_id" => "2", "name" => "Electronics Engineering Department"]);
        Department::create(["sector_id" => "2", "name" => "Electrical Engineering Department"]);
        Department::create(["sector_id" => "2", "name" => "Civil Engineering Technology Department"]);
        Department::create(["sector_id" => "2", "name" => "Mechanical Engineering Technology Department"]);
        Department::create(["sector_id" => "2", "name" => "Food and Apparel Technology Department"]);
        Department::create(["sector_id" => "2", "name" => "Graphics Arts and Printing Technology Department"]);
        Department::create(["sector_id" => "2", "name" => "College of Industrial Technology Deparment"]);
        Department::create(["sector_id" => "2", "name" => "College of Liberal Arts Dean Office"]);
        Department::create(["sector_id" => "2", "name" => "College of Industrial Education Dean Office"]);
        Department::create(["sector_id" => "2", "name" => "College of Science Dean Office"]);
        Department::create(["sector_id" => "2", "name" => "College of Engineering Dean Office"]);
        Department::create(["sector_id" => "2", "name" => "College of Architecture and Fine Arts Dean Office"]);

        //Administration and Finance
        Department::create(["sector_id" => "3", "name" => "Admin Office"]);
        Department::create(["sector_id" => "3", "name" => "Procurement"]);
        Department::create(["sector_id" => "3", "name" => "Supply Office"]);
        Department::create(["sector_id" => "3", "name" => "Budget Office"]);

        //Research and Extension
        Department::create(["sector_id" => "4", "name" => "Office of the Vice President for Research and Extension"]);

        //Planning Development and Information System
        Department::create(["sector_id" => "5", "name" => "Planning Office"]);
    }
}
