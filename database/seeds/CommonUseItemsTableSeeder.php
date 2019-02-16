<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\CommonUseItem;

class CommonUseItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        $reader->setSheetIndex(0);
        $catalogPath = Storage::disk('public')->path('templates\cse_items_seed.csv');
        $spreadsheet = $reader->load($catalogPath);

        $items = $spreadsheet->getActiveSheet()->toArray();
        foreach($items as $item){
            CommonUseItem::create([
                "code" => $item[0],
                "description" => $item[1],
                "uom" => $item[2],
                "price" => (is_string($item[3])) ? (float)str_replace(",", "", $item[3]): $item[3],
                "item_type_id" => $item[4]
            ]);
        }
    }
}
