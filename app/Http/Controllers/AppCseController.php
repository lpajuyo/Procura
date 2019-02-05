<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\BudgetYear;

class AppCseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(BudgetYear $budgetYear = null)
    {
        if($budgetYear == null)
            $budgetYear = BudgetYear::active()->first();

        $approvedItems = $budgetYear->projects()->approved()->get()->flatMap->items->where('is_cse', 1)->groupBy->code;

        $templatePath = Storage::disk('public')->path('templates\app_cse_template.xlsm');
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder() );

        $spreadsheet = $reader->load($templatePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $rowCoordinate = collect();
        $test = collect();
        for($row = 34; $row <= 385; $row++){
            if($worksheet->getCellByColumnAndRow(2, $row)->getValue()){
                $code = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $rowCoordinate[$code] = $row;
            }
        }

        foreach($approvedItems->keys() as $key){
            $itemScheds = $approvedItems[$key]->flatMap->schedules->groupBy->id;
            for($i = 1; $i <= 3; $i++){
                if($itemScheds->has($i)){
                    // dd($itemScheds[$i]->sum('pivot.quantity'));
                    // dd($rowCoordinate[$key]);
                    $worksheet->setCellValueByColumnAndRow($i+4, $rowCoordinate[$key], $itemScheds[$i]->sum('pivot.quantity'));
                    // dd($worksheet->getCellByColumnAndRow($i+4, $rowCoordinate[$key]));
                }
            }
            for($i = 4; $i <= 6; $i++){
                if($itemScheds->has($i))
                $worksheet->setCellValueByColumnAndRow($i+6, $rowCoordinate[$key], $itemScheds[$i]->sum('pivot.quantity'));
            }
            for($i = 7; $i <= 9; $i++){
                if($itemScheds->has($i))
                $worksheet->setCellValueByColumnAndRow($i+8, $rowCoordinate[$key], $itemScheds[$i]->sum('pivot.quantity'));
            }
            for($i = 10; $i <= 12; $i++)
                if($itemScheds->has($i)){
                $worksheet->setCellValueByColumnAndRow($i+10, $rowCoordinate[$key], $itemScheds[$i]->sum('pivot.quantity'));
            }
        }

        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Html($spreadsheet);
        // $writer->save('php://output');

        //temp download spreadsheet
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="lala.xlsm"');
        header('Cache-Control: max-age=0');
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
    }
}
