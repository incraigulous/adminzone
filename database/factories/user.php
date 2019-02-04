<?php

use Faker\Generator as Faker;

$factory->define(\Incraigulous\AdminZone\Models\User::class, function (Faker $faker) {
    $avatar = factory(\Incraigulous\AdminZone\Models\Asset::class)->create();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'avatar_id' => $avatar->id
    ];
});
