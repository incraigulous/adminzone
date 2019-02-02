<?php

$factory->define(\Incraigulous\AdminZone\Models\Revision::class, function (Faker\Generator $faker) {
    return [
        'revisionable_type' => \Incraigulous\AdminZone\Models\User::class,
        'revisionable_id' => $faker->numberBetween(1, 30),
        'user_id' => $faker->numberBetween(1, 30),
        'message' => $faker->randomElement(null, $faker->sentence), // secret
        'data' => factory(\Incraigulous\AdminZone\Models\User::class)->make()->toArray()
    ];
});

$factory->state(\Incraigulous\AdminZone\Models\Revision::class, 'user', function ($faker) {
    return [
        'revisionable_id' => \Incraigulous\AdminZone\Models\User::all()->random()->first()->id,
        'user_id' => \Incraigulous\AdminZone\Models\User::all()->random()->first()->id,
    ];
});
