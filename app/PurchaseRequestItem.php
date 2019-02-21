<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequestItem extends Model
{
    protected $fillable = ['purchase_request_id', 'project_item_id', 'specifications', 'quantity', 'total_cost'];

    public function project_item(){
        return $this->belongsTo('App\ProjectItem');
    }

    public function purchase_request(){
        return $this->belongsTo('App\PurchaseRequest');
    }
}
