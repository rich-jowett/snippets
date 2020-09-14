<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Snippet;
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

$factory->define(Snippet::class, function (Faker $faker) {
    $createdAt = $faker->dateTimeThisMonth();

    return [
        'id' => $faker->uuid,
        'code' => base64_encode($faker->sentences(3, true)),
        'created_at' => $createdAt,
        'updated_at' => $faker->dateTimeBetween($createdAt),
    ];
});
