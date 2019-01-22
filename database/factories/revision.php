<?php

use Incraigulous\AdminZone\Models\Revision;
use Incraigulous\AdminZone\Models\User;

$factory->define(Revision::class, function (Faker\Generator $faker) {
    return [
        'revisionable_type' => \Incraigulous\AdminZone\Models\User::class,
        'revisionable_id' => $faker->numberBetween(1, 30),
        'user_id' => $faker->numberBetween(1, 30),
        'message' => $faker->randomElement(null, $faker->sentence), // secret
        'data' => factory(\Incraigulous\AdminZone\Models\User::class)->make()->toArray()
    ];
});

$factory->state(Revision::class, 'user', function ($faker) {
    return [
        'revisionable_id' => User::all()->random()->first()->id,
        'user_id' => User::all()->random()->first()->id,
    ];
});
