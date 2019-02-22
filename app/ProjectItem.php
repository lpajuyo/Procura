<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectItem extends Model
{
    protected $fillable = ['project_id', 'code', 'description', 'quantity', 'uom', 'unit_cost', 'estimated_budget', 'procurement_mode', 'is_cse', 'item_type_id'];

    protected $touches = ['project'];

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function schedules(){
        return $this->belongsToMany('App\Schedule')->withPivot('quantity')->withTimestamps();
    }

    public function pr_items(){
        return $this->hasMany('App\PurchaseRequestItem');
    }

    public function getRemainingQuantityAttribute(){
        $pr_items = $this->pr_items;
        
        $requestedQty = 0;
        foreach($pr_items as $item){
            if($item->purchase_request->is_approved == true || $item->purchase_request->is_approved == null)
                $requestedQty = bcadd($requestedQty, $item->quantity);
        }

        return bcsub($this->quantity, $requestedQty);
    }

    public function scopeCse($query){
        return $query->where('is_cse', 1);
    }

    public function addSchedules($schedules){
        $this->schedules()->sync($schedules);
    }
}
