<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['budget_year_id', 'title', 'user_id', 'department_budget_id'];

    public function items(){
        return $this->hasMany('App\ProjectItem');
    }
}
