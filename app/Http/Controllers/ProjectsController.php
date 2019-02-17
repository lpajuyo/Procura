<?php

namespace App\Http\Controllers;

use App\Project;
use App\BudgetYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ProjectsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        bcscale(2);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewProjects', Project::class);

        $user = Auth::user();
        $activeYear = BudgetYear::active()->first();
        if($activeYear == null)
            abort(497, "There is no Active Budget Year set. Please wait until one is set.");

        if($user->type->name == "Sector Head"){
            $projects = Project::whereNotNull('submitted_at')
                                    ->orderByRaw('IF(is_approved IS NULL, 0, 1), is_approved DESC')
                                    ->oldest('submitted_at')
                                    ->get();
            $projects = $projects->filter(function($project){
                return $project->approver->id == Auth::user()->id;
            });
        }
        else if($user->type->name == "Department Head"){
            $projects = $user->projects()
                                ->orderByRaw('IF(is_approved IS NULL, 0, 1), is_approved DESC')
                                ->orderBy('submitted_at', 'asc')
                                ->get();

            if($user->userable->department->isUnallocated($activeYear))
                request()->session()->flash('dept_budget_error', 'There is no allocated budget for your department at this time. You can\'t create PPMPs yet.');
        }
        
        $projects = $projects->where('budget_year_id', $activeYear->id);

        return view("user_viewppmp", compact('projects', 'activeYear'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Project::class);

        $activeYear = BudgetYear::active()->first();

        if(is_null($activeYear))
            abort(497, 'Unathorized Action. There is no active Budget Year set.');

        return view("create_project", compact('activeYear'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);

        $attributes = $request->validate([
            'budget_year_id' => 'exists:budget_years,id',
            'title' => 'required|string'
        ]);

        $user = Auth::user();
        $budgetYear = BudgetYear::find($attributes['budget_year_id']);
        $attributes['user_id'] = $user->id;
        $attributes['department_budget_id'] = $budgetYear->departmentBudgets->firstWhere('department_id', $user->userable->department_id)->id;
        // dd($attributes);
        $project = Project::create($attributes);

        return redirect(route('items.create', ["project" => $project->id]));
    }

    public function generateFile(Project $project){
        $this->authorize('viewFile', $project);

        $templatePath = Storage::disk('public')->path('templates\ppmp_template.xlsx');
        // \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder());
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        // $spreadsheet = new Spreadsheet();
        $spreadsheet = $reader->load($templatePath);
        $spreadsheet->getActiveSheet()->setCellValue('D9', $project->user->name . ' / ' . $project->department->name)
                                        ->setCellValue('D10', $project->title)
                                        ->setCellValue('B30', $project->user->name);

        if(is_null($project->submitted_at) || is_null($project->is_approved) || $project->is_approved == false){
            $spreadsheet->getActiveSheet()->setCellValue('A28', 'NOTE:');
            $spreadsheet->getActiveSheet()->setCellValue('B28', 'This is not the official PPMP.');
        }

        if($project->is_approved == true){
            $spreadsheet->getActiveSheet()->setCellValue('O30', $project->approver->name);
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return $project->load('items.schedules')->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return back();
    }
}
