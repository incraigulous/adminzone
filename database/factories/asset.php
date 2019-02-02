<?php

$factory->define(\Incraigulous\AdminZone\Models\Asset::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->randomElement($faker->words(random_int(1, 3))),
        'filename' => $faker->word . $faker->fileExtension,
        'file' => $faker->imageUrl(),
        'filesystem' => 's3'
    ];
});
