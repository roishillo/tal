<?php

use App\Models\Entities\Educand;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Educand::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'about_me' => $faker->sentence,
        'address' => $faker->address,
        'contact_first_name' => $faker->firstName,
        'contact_last_name' => $faker->lastName,
        'contact_last_email' => $faker->email,
        'contact_last_phone' => $faker->phoneNumber,
        'disability_level' => $faker->randomDigit,
        'gender' => $faker->randomLetter,
        'visual_resource_path' =>$faker->url,
        'current_state' => $faker->sentence,
        'birth_date' => $faker->dateTime,
        'admin_id' => $faker->numberBetween(1,2)
    ];
});
