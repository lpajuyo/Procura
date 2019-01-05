<?php

use Illuminate\Database\Seeder;
use App\DepartmentHead;

class DepartmentHeadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DepartmentHead::create(["department_id" => 1]);
        DepartmentHead::create(["department_id" => 2]);
        DepartmentHead::create(["department_id" => 3]);
    }
}
