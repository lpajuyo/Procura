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
    public function __invoke(BudgetYear $budgetYear)
    {
        $approvedItems = $budgetYear->projects()->approved()->get()->flatMap->items->where('is_cse', 1)->groupBy->code;

        $templatePath = Storage::disk('public')->path('templates\app_cse_template.xlsm');
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder() );
        $reader->getReadDataOnly(true);

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
            $worksheet->setCellValueByColumnAndRow(25, $rowCoordinate[$key], $approvedItems[$key]->sum('quantity'));
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
