<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['budget_year_id', 'title', 'user_id', 'department_budget_id'];

    public function items(){
        return $this->hasMany('App\ProjectItem');
    }

    public function year(){
        return $this->belongsTo('App\BudgetYear', 'budget_year_id');
    }

    public function department_budget(){
        return $this->belongsTo('App\DepartmentBudget');
    }

    public function addItem($attributes){
        // dd($attributes);
        $project_item = $this->items()->create($attributes);
        $project_item->addSchedules($attributes['schedules']);
    }

    public function getApproverAttribute(){
        return $this->department_budget->department->sector->head->user;
    }

    public function getDepartmentAttribute(){
        return $this->department_budget->department;
    }
}
