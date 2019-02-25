<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommonUseItem extends Model
{
    protected $guarded = [];

    public function type(){
        return $this->belongsTo('App\ItemType', 'item_type_id');
    }
}
