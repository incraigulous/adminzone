<?php

use Incraigulous\DataFactories\DataFactory;

$faker = \Faker\Factory::create();
require_once __DIR__ . '/fieldType.php';

DataFactory::define('field', function() use ($faker) {
    return [
        'name' => $faker->word,
        'label' => $faker->word,
        'type' => DataFactory::make('field-type')->toArray(),
        'default' => $faker->word,
    ];
});

DataFactory::define('field:text', function() use ($faker) {
    return [
        'name' => $faker->word,
        'label' => $faker->word,
        'type' => DataFactory::make('field-type:text')->toArray(),
        'default' => $faker->word,
    ];
});
