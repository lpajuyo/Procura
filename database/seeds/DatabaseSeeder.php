<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTypesTableSeeder::class,
            UsersTableSeeder::class,
            SectorsTableSeeder::class,
            DepartmentsTableSeeder::class,
            DepartmentHeadsTableSeeder::class,
            SectorHeadsTableSeeder::class,
            SchedulesTableSeeder::class,
            CommonUseItemsTableSeeder::class,
            ItemTypesTableSeeder::class,
        ]);
    }
}
