<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectItem extends Model
{
    protected $fillable = ['project_id', 'code', 'description', 'quantity', 'uom', 'unit_cost', 'estimated_budget', 'procurement_mode'];

    public function schedules(){
        return $this->belongsToMany('App\Schedule')->withTimestamps();
    }

    public function addSchedules($schedules){
        $this->schedules()->sync($schedules);
    }
}
