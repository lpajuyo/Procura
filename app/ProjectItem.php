<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectItem extends Model
{
    protected $fillable = ['project_id', 'code', 'description', 'quantity', 'uom', 'unit_cost', 'estimated_budget', 'procurement_mode', 'is_cse'];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function schedules(){
        return $this->belongsToMany('App\Schedule')->withPivot('quantity')->withTimestamps();
    }

    public function scopeCse($query){
        return $query->where('is_cse', 1);
    }

    public function addSchedules($schedules){
        $this->schedules()->sync($schedules);
    }
}
