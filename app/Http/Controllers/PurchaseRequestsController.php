<?php

namespace App\Http\Controllers;

use App\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class PurchaseRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewPurchaseRequests', PurchaseRequest::class);

        $user = Auth::user();
        if($user->id == setting()->get('pr_approver_id', 8)){
            $purchaseRequests = PurchaseRequest::whereNotNull('submitted_at')
                                                ->orderByRaw('IF(is_approved IS NULL, 0, 1), is_approved DESC')
                                                ->oldest('submitted_at')
                                                ->get();
            $purchaseRequests = $purchaseRequests->filter(function($purchaseRequest){
                return $purchaseRequest->approver->id == Auth::user()->id;
            });
        }
        else if($user->type->name == "Department Head"){
            $purchaseRequests = $user->purchase_requests;

            $projects = Auth::user()->projects()->where('is_approved', 1)->get();
            if($projects->count() == 0)
                request()->session()->flash('approved_proj_error', 'You have no approve PPMPs at this time. You can\'t create Purchase Requests yet.');
        }
        return view('user_pr', compact('purchaseRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', PurchaseRequest::class);

        $projects = Auth::user()->projects()->where('is_approved', 1)->get();

        //create pr_number
        $now = new Carbon();
        $pr_year = $now->year;
        $pr_month = str_pad($now->month, 2, "0", STR_PAD_LEFT);
        $pr_serial = PurchaseRequest::whereYear('created_at', $pr_year)->count() + 1;
        $pr_number = $pr_year . '-' . $pr_month . '-' . str_pad($pr_serial, 4, "0", STR_PAD_LEFT);

        return view('create_purchase_request', compact('pr_number', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', PurchaseRequest::class);

        // dd($request->all());

        $attributes = $request->validate([
            'project_id' => [
                'required',
                Rule::exists('projects', 'id')->where('is_approved', 1),
                ],
            'purpose' => 'required|string',
            'pr_number' => 'required|unique:purchase_requests'
        ]);

        $pr = PurchaseRequest::create(['project_id' => $request->project_id, 'pr_number' => $request->pr_number, 'purpose' => $request->purpose]);

        return redirect()->route('pr_items.create', ['purchase_request' => $pr->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequest $purchaseRequest)
    {
        $this->authorize('view', $purchaseRequest);

        return $purchaseRequest->load('items.project_item')->toJson();
    }

    public function showFile(PurchaseRequest $purchaseRequest){
        $this->authorize('view', $purchaseRequest);

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
        // $worksheet->setCellValue('C58', $purchaseRequest->requestor->name); //requestor designation

        if($purchaseRequest->is_approved){
            // $worksheet->setCellValue('E55', $purchaseRequest->purpose); //approver signature
            $worksheet->setCellValue('E57', $purchaseRequest->approver->name); //approver signature
            // $worksheet->setCellValue('E58', $purchaseRequest->purpose); //approver designation
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequest $purchaseRequest)
    {
        $this->authorize('delete', $purchaseRequest);

        $purchaseRequest->delete();

        return back();
    }
}
