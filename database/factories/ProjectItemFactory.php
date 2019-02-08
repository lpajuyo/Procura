<?php

use Faker\Generator as Faker;
use App\CommonUseItem;

$factory->define(App\ProjectItem::class, function (Faker $faker) {
    return [
        "description" => $faker->text(20),
        "estimated_budget" => $faker->randomFloat(2),
        "is_cse" => 0
    ];
});

$factory->afterCreating(App\ProjectItem::class, function ($projectItem, $faker) {
    $scheds = factory(App\ProjectItemSchedule::class, 3)->make();
    $projectItem->schedules()->sync($scheds->toArray());
    $projectItem->update(['quantity' => $scheds->sum('quantity')]);

    if($projectItem->is_cse){
        $estimated_budget = bcmul($projectItem->quantity, $projectItem->unit_cost, 5);
        $projectItem->update(['estimated_budget' => number_format($estimated_budget, 2, '.', '')]);
    }
});

$factory->state(App\ProjectItem::class, 'cse', function($faker){
    $cseItem = CommonUseItem::inRandomOrder()->first();
    return [
        'is_cse' => 1,
        'code' => $cseItem->code,
        'description' => $cseItem->description,
        'uom' => $cseItem->uom,
        'unit_cost' => $cseItem->price,
    ];
});