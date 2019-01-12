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
        $projects = Project::all();
        
        return view("user_viewppmp", compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Project::class);

        $budgetYears = BudgetYear::all();

        return view("create_project", compact('budgetYears'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $attributes = $request->validate([
            'budget_year_id' => 'exists:budget_years,id',
            'title' => 'required|string'
        ]);

        $user = Auth::user();
        $budgetYear = BudgetYear::find($attributes['budget_year_id']);
        $attributes['user_id'] = $user->id;
        $attributes['department_budget_id'] = $budgetYear->departmentBudgets->firstWhere('department_id', 1)->id;
        // dd($attributes);
        $project = Project::create($attributes);

        return redirect(route('items.create', ["project" => $project->id]));
    }

    public function generateFile(Project $project){
        $this->authorize('viewFile', $project);

        // $projectArray = $project->load('items')->toArray();
        // $projectArray['items'] = array_map(function($item){
        //     $item['quantity'] = 'lala';// . $item['quantity'] . ' ' . $item['uom'];
        //     array_forget($item, 'uom');
        //     array_forget($item, 'id');
        //     array_forget($item, 'project_id');
        //     array_forget($item, 'created_at');
        //     array_forget($item, 'updated_at');
        //     return array_values($item);
        // }, $projectArray['items']);
        // dd($projectArray);

        $templatePath = Storage::disk('public')->path('templates\ppmp_template.xlsx');
        // \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder( new \PhpOffice\PhpSpreadsheet\Cell\AdvancedValueBinder());
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        // $spreadsheet = new Spreadsheet();
        $spreadsheet = $reader->load($templatePath);
        $spreadsheet->getActiveSheet()->setCellValue('D9', $project->user->name . ' / ' . $project->department->name)
                                        ->setCellValue('D10', $project->title)
                                        ->setCellValue('B30', $project->user->name);
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
        //
    }
}
