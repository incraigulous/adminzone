<?php
use Faker\Factory;


/**
 * Class AdminZoneSeeder
 */
class AdminZoneSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $faker = Factory::create();
        factory(\Incraigulous\AdminZone\Models\User::class, $faker->randomNumber(2))->create();
        factory(\Incraigulous\AdminZone\Models\Asset::class, $faker->randomNumber(2))->create();
    }
}
