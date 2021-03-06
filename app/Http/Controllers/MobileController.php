<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseRequest;
use App\Project;
use App\BudgetProposal;
use App\Notifications\PurchaseRequestApproved;
use App\Notifications\PurchaseRequestRejected;
use App\Notifications\ProjectApproved;
use App\Notifications\ProjectRejected;
use App\Notifications\BudgetProposalApproved;
use App\Notifications\BudgetProposalRejected;
use App\BudgetYear;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MobileController extends Controller
{
    public function showPrFile(PurchaseRequest $purchaseRequest){
        // $this->authorize('view', $purchaseRequest);

        $templatePath = Storage::disk('public')->path('templates\pr_template.xlsx');
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder() );

        $spreadsheet = $reader->load($templatePath);
        $worksheet = $spreadsheet->getActiveSheet();

        $worksheet->setCellValue('C8', $purchaseRequest->project->department->name);
        $worksheet->setCellValue('C9', $purchaseRequest->project->department->sector->name);
        $worksheet->setCellValue('D8', 'P.R. No. ' . $purchaseRequest->pr_number);
        $worksheet->setCellValue('C52', $purchaseRequest->purpose);
        // $worksheet->setCellValue('C55', $purchaseRequest->purpose); //requestor signature
        $worksheet->setCellValue('C57', $purchaseRequest->requestor->name);
        $worksheet->setCellValue('C58', $purchaseRequest->requestor->position); //requestor designation

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setPath(storage_path('app/public/'.$purchaseRequest->requestor->user_signature));
        $drawing->setCoordinates('C55');
        $drawing->setOffsetX(120);
        $drawing->setOffsetY(-12);
        $drawing->setWidthAndHeight(143, 75);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        if($purchaseRequest->is_approved){
            // $worksheet->setCellValue('E55', $purchaseRequest->purpose); //approver signature
            $worksheet->setCellValue('E57', $purchaseRequest->approver->name); //approver signature
            $worksheet->setCellValue('E58', $purchaseRequest->approver->position); //approver designation
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setPath(storage_path('app/public/'.$purchaseRequest->approver->user_signature));
            $drawing->setCoordinates('E55');
            $drawing->setOffsetX(40);
            $drawing->setOffsetY(-12);
            $drawing->setWidthAndHeight(143, 75);
            $drawing->setWorksheet($spreadsheet->getActiveSheet());
        }

        

        $row = 12;
        $n = 1;
        foreach($purchaseRequest->items as $item){
            $col = 1;
            $worksheet->setCellValueByColumnAndRow($col++, $row, $n++);
            $worksheet->setCellValueByColumnAndRow($col++, $row, $item->project_item->uom);
            $worksheet->setCellValueByColumnAndRow($col++, $row, $item->project_item->description . "\n" . $item->specifications);
            $worksheet->setCellValueByColumnAndRow($col++, $row, $item->quantity);
            $worksheet->setCellValueByColumnAndRow($col++, $row, $item->project_item->unit_cost);
            $worksheet->setCellValueByColumnAndRow($col++, $row, $item->total_cost);
            $row++;
        }

        $itemCount =$purchaseRequest->items->count();
        if($itemCount < 39){
            $worksheet->removeRow($row, 39-$itemCount);
        }

        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Html($spreadsheet);
        // $writer->save('php://output');

        //temp download spreadsheet
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="PR-' . $purchaseRequest->pr_number . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
    }

    public function showPpmpFile(Project $project){
        // $this->authorize('viewFile', $project);

        $templatePath = Storage::disk('public')->path('templates\ppmp_template.xlsx');
        // \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder());
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        // $spreadsheet = new Spreadsheet();
        $spreadsheet = $reader->load($templatePath);
        $spreadsheet->getActiveSheet()->setCellValue('D9', $project->user->name . ' / ' . $project->department->name)
                                        ->setCellValue('D10', $project->title)
                                        ->setCellValue('B30', $project->user->name)
                                        ->setCellValue('B31', $project->user->position);

        if(is_null($project->submitted_at) || is_null($project->is_approved) || $project->is_approved == false){
            $spreadsheet->getActiveSheet()->setCellValue('A28', 'NOTE:');
            $spreadsheet->getActiveSheet()->setCellValue('B28', 'This is not the official PPMP.');
        }

        $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $drawing->setPath(storage_path('app/public/'.$project->user->user_signature));
        $drawing->setCoordinates('B28');
        $drawing->setWidthAndHeight(143, 75);
        $drawing->setWorksheet($spreadsheet->getActiveSheet());

        if($project->is_approved == true){
            $spreadsheet->getActiveSheet()->setCellValue('O30', $project->approver->name);
            $spreadsheet->getActiveSheet()->setCellValue('O31', $project->approver->position);
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setPath(storage_path('app/public/'.$project->approver->user_signature));
            $drawing->setCoordinates('O28');
            $drawing->setWidthAndHeight(143, 75);
            $drawing->setWorksheet($spreadsheet->getActiveSheet());
        }

        if($project->items->count() > 7)
            $spreadsheet->getActiveSheet()->insertNewRowBefore(21, $project->items->count() - 7);
        // $spreadsheet->getActiveSheet()->fromArray($projectArray['items'], NULL, 'A14');
        $row = 14;
        foreach($project->items as $item){
            $col = 1;
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $item->code);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow($col++, $row, $item->description);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(++$col, $row, $item->quantity . ' ' . $item->uom);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(++$col, $row, $item->unit_cost);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(++$col, $row, $item->estimated_budget);
            $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(++$col, $row, $item->procurement_mode);
            
            for($i = 1; $i<=12 ; $i++){
                if($item->schedules->contains('id', $i))
                    $spreadsheet->getActiveSheet()->setCellValueByColumnAndRow(++$col, $row, "✔");
                else
                    ++$col;
            }

            $row++;
        }
        
        //temp download spreadsheet
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="PPMP-' . $project->id . '-' . $project->title . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');

        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        // $writer->save(Storage::path('ppmp_files') . '/PPMP-' . $project->id . '-' . $project->title . '.xlsx');

        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Html($spreadsheet);
        // $writer->save('php://output');

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
    }

    public function approvePpmp(Request $request, Project $project)
    {
        // $this->authorize('approveProject', $project);

        $project->approve($request->remarks);
        // $project->approve();

        $project->user->notify(new ProjectApproved());

        // return redirect()->route('projects.index');
    }

    public function rejectPpmp(Request $request, Project $project)
    {
        // $this->authorize('approveProject', $project);

        $project->reject($request->remarks);
        // $project->reject();

        $project->user->notify(new ProjectRejected());

        // return redirect()->route('projects.index');
        // return 'Success';
    }

    public function approvePr(Request $request, PurchaseRequest $purchaseRequest)
    {
        // $this->authorize('approve', $purchaseRequest);

        $purchaseRequest->approve($request->remarks);
        // $purchaseRequest->approve();

        $purchaseRequest->requestor->notify(new PurchaseRequestApproved());

        // return redirect()->route('purchase_requests.index');
    }

    public function rejectPr(Request $request, PurchaseRequest $purchaseRequest)
    {
        // $this->authorize('approve', $purchaseRequest);

        $purchaseRequest->reject($request->remarks);
        // $purchaseRequest->reject();

        $purchaseRequest->requestor->notify(new PurchaseRequestRejected());

        // return redirect()->route('purchase_requests.index');
    }

    public function approveProposal(Request $request, BudgetProposal $budgetProposal)
    {
        // $this->authorize('approve', $budgetProposal);

        $budgetProposal->approve($request->remarks);

        $budgetProposal->submitter->notify(new BudgetProposalApproved);

        // return redirect('/budget_proposals');
    }

    public function rejectProposal(Request $request, BudgetProposal $budgetProposal)
    {
        // $this->authorize('approve',$budgetProposal);

        $budgetProposal->reject($request->remarks);

        $budgetProposal->submitter->notify(new BudgetProposalRejected);

        // return redirect('budget_proposals');
    }

    public function viewAppCse(BudgetYear $budgetYear = null)
    {
        // $this->authorize('view-APP');

        set_time_limit(0);

        if($budgetYear == null)
            $budgetYear = BudgetYear::active()->first();
        
        if($budgetYear == null)
            abort(497, "There is no Active Budget Year set. Please wait until one is set.");

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
        header('Content-Disposition: attachment;filename="APP_' . $budgetYear->budget_year . '_CSE_systemgenerated' . Carbon::now()->toDateString() . '.xlsm"');
        header('Cache-Control: max-age=0');
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
    }

    public function viewAppNonCse(BudgetYear $budgetYear = null)
    {
        // $this->authorize('view-APP');
    
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
