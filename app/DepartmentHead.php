<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentHead extends Model
{
    protected $fillable = ['department_id'];

    public function department(){
        return $this->belongsTo('App\Department');
    }
}
