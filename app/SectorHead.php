<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorHead extends Model
{
    protected $fillable = ['sector_id'];

    public function sector(){
        return $this->belongsTo('App\Sector');
    }

    public function user(){
        return $this->morphOne('App\User', 'userable');
    }
}
