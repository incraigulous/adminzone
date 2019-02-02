<?php

namespace Incraigulous\AdminZone;

use Illuminate\Database\Seeder;

/**
 * Class Seeder
 */
class SeederFactory
{
    static function make(): Seeder {
        return \Illuminate\Database\Eloquent\Factory::construct(
        // faker
            \Faker\Factory::create(),

            // custom path to factories folder
            base_path(__DIR__ . '/../database/seeds')
        );
    }
}
