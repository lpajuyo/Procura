<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProjectItem;
use Carbon\Carbon;

class Project extends Model
{
    protected $guarded = ['id'];

    protected $appends = ['total_budget', 'total_budget_with_contingency'];

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
        // return User::find(setting()->get('pr_approver_id', 8));
    }
    
    public function getDepartmentAttribute(){
        return $this->department_budget->department;
    }

    public function setTotalBudgetAttribute($value){
        $this->attributes['total_budget'] = $value;
    }

    public function getTotalBudgetAttribute(){
        if(isset($this->attributes['total_budget']))
            return $this->attributes['total_budget'];

        $items = $this->items;

        $total=0;
        foreach($items as $item){
            $total = bcadd($total, $item->estimated_budget);
        }

        return $total;
    }

    public function getTotalBudgetWithContingencyAttribute(){
        $total = bcadd($this->total_budget, bcmul($this->total_budget, "0.20", 5), 5);
        return number_format($total, 2, ".", "");
    }

    public function scopeApproved($query){
        return $query->where('is_approved', 1);
    }

    public function addItem($attributes){
        // dd($attributes);
        $project_item = $this->items()->create($attributes);
        $project_item->addSchedules($attributes['schedules']);
    }

    public function updateItem(ProjectItem $projectItem, $attributes){
        // dd($attributes);
        $projectItem->update($attributes);
        $projectItem->addSchedules($attributes['schedules']);
    }

    public function approve($remarks, $approved = true){
        $this->update(["is_approved" => $approved, "remarks" => $remarks]);
    }

    public function reject($remarks){
        $this->approve($remarks, false);
    }

    public function submit(){
        $this->update(['submitted_at' => Carbon::now()]);
    }

    public function unsubmit(){
        $this->update(['submitted_at' => null]);
    }
}
