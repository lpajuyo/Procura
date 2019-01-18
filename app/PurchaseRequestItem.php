<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestItem extends Model
{
    protected $guarded = [];

    public function project_item(){
        return $this->belongsTo('App\ProjectItem');
    }
}
