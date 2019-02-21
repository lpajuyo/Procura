<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\BudgetYear;
use Carbon\Carbon;

class AppNonCseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(BudgetYear $budgetYear = null)
    {
        $this->authorize('view-APP');
    
        set_time_limit(0);

        if($budgetYear == null)
            $budgetYear = BudgetYear::active()->first();

        if($budgetYear == null)
        abort(497, "There is no Active Budget Year set. Please wait until one is set.");
            
        $approvedItems = $budgetYear->projects()->approved()->get()->flatMap->items->where('is_cse', 0)->sortBy('description')->values();

        $templatePath = Storage::disk('public')->path('templates\app_non_cse_template.xlsx');
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        // $reader->setReadDataOnly(true);
        $reader->setLoadSheetsOnly('app');
        // \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder() );

        $spreadsheet = $reader->load($templatePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $row = 5;
        foreach($approvedItems as $item){
            $worksheet->setCellValueByColumnAndRow(1, $row, $item->code);
            $worksheet->setCellValueByColumnAndRow(2, $row, $item->description);
            $worksheet->setCellValueByColumnAndRow(3, $row, $item->project->department->name);
            $worksheet->setCellValueByColumnAndRow(10, $row, $item->estimated_budget);
            $row++;
        }

        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Html($spreadsheet);
        // $writer->save('php://output');

        //temp download spreadsheet
        // header('Content-Type: application/vnd.oasis.opendocument.spreadsheet');
        // header('Content-Disposition: attachment;filename="lala.ods"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="APP_' . $budgetYear->budget_year . '_NON-CSE_systemgenerated' . Carbon::now()->toDateString() . '.xlsx"');
        header('Cache-Control: max-age=0');
        // $storagePath = Storage::path('app_non_cse_files');
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
    }
}
