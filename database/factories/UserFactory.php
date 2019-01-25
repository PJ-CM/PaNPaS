<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    $username = ".";

    while (strpos($username, '.') !== false){
        $username = $faker->unique()->userName;
    }

    $randomDate = $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now');

    return [
        'username' => $username,
        'name' => $faker->firstname,
        'lastname' => $faker->lastname,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'email_verified_at' => $randomDate,
        //Contraseña aleatoria para cada uno
        ////'password' => Hash::make(str_random(10)),
        //Contraseña igual para todos
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'avatar' => $faker->imageUrl($width = 640, $height = 480),
        'created_at' => $randomDate,
        'updated_at' => $randomDate,
    ];
});
