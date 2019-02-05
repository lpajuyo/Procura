<?php

use Faker\Generator as Faker;

$factory->define(App\ProjectItemSchedule::class, function (Faker $faker) {
    return [
        'schedule_id' => $faker->numberBetween(1, 12),
        'quantity' => $faker->randomDigitNotNull
    ];
});
