<?php

use Incraigulous\DataFactories\DataFactory;

$faker = \Faker\Factory::create();

DataFactory::define('field-type', function() use ($faker) {
    return [
        'name' => $faker->randomElement(['Text Field', 'Text Area', 'Rich Text']),
        'component' => $faker->randomElement(['text-field', 'text-area', 'rich-text'])
    ];
});

DataFactory::define('field-type:text', function() use ($faker) {
    return [
        'name' => 'Text Field',
        'component' => 'text-field'
    ];
});

