<?php
namespace Incraigulous\AdminZone\Seeders;

use Incraigulous\AdminZone\Models\User;
use Faker\Factory;



/**
 * Class AdminZoneSeeder
 */
class AdminZoneSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $faker = Factory::create();
        factory(User::class, $faker->randomNumber(2))->create();
    }
}
