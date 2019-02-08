<?php

use Faker\Generator as Faker;
use App\BudgetYear;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        "budget_year_id" => BudgetYear::active()->first()->id,
        "user_id" => 2,
        "department_budget_id" => 1,
        "title" => $faker->text(20),
        "is_approved" => $faker->boolean(50)
    ];
});

$factory->state(App\Project::class, 'approved', [
    'is_approved' => 1,
]);

$factory->state(App\Project::class, 'cse', []);

$factory->afterCreating(App\Project::class, function ($project, $faker) {
    $project->items()->save(factory(App\ProjectItem::class)->create(['project_id' => $project->id]));
    $project->items()->save(factory(App\ProjectItem::class)->create(['project_id' => $project->id]));
    $project->items()->save(factory(App\ProjectItem::class)->create(['project_id' => $project->id]));
});

$factory->afterCreatingState(App\Project::class, 'cse', function ($project, $faker) {
    $project->items()->save(factory(App\ProjectItem::class)->states('cse')->create(['project_id' => $project->id]));
    $project->items()->save(factory(App\ProjectItem::class)->states('cse')->create(['project_id' => $project->id]));
    $project->items()->save(factory(App\ProjectItem::class)->states('cse')->create(['project_id' => $project->id]));
});

