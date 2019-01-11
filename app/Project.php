<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['budget_year_id', 'title', 'user_id', 'department_budget_id', 'is_approved'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function items(){
        return $this->hasMany('App\ProjectItem');
    }

    public function year(){
        return $this->belongsTo('App\BudgetYear', 'budget_year_id');
    }

    public function department_budget(){
        return $this->belongsTo('App\DepartmentBudget');
    }

    public function getApproverAttribute(){
        return $this->department_budget->department->sector->head->user;
    }
    
    public function getDepartmentAttribute(){
        return $this->department_budget->department;
    }

    public function addItem($attributes){
        // dd($attributes);
        $project_item = $this->items()->create($attributes);
        $project_item->addSchedules($attributes['schedules']);
    }

    public function approve($approved = true){ //public function approve($remarks, $approved = true){
        $this->update(["is_approved" => $approved]);
        // $this->addRemarks($remarks);
    }

    public function reject(){ //    public function reject($remarks){
        // $this->approve($remarks, false);
        $this->approve(false);
    }

    // public function addRemarks($remarks){
    //     $this->update(compact("remarks"));
    // }
}
