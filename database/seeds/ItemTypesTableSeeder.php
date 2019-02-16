<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_types')->insert([
            'name' => 'Electrical Supplies',
            'name' => 'Office Supplies',
            'name' => 'Office Equipment',
            'name' => 'Janitorial Supplies',
            'name' => 'Paper Products',
            'name' => 'Writing Supplies',
            'name' => 'Computer Supplies',
            'name' => 'Consumable Items',
        ]);
    }
}
