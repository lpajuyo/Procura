<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'user_type_id', 'userable_id', 'userable_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function type(){
        return $this->belongsTo('App\UserType', 'user_type_id');
    }

    public function userable(){
        return $this->morphTo();
    }

    public function budget_proposals(){
        return $this->hasMany('App\BudgetProposal');
    }

    public function projects(){
        return $this->hasMany('App\Project');
    }

    public function addProposal($attributes){
        $attributes['department_id'] = $this->userable->department_id;
        $this->budget_proposals()->create($attributes);
    }
}
