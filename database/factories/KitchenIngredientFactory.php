<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
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

$factory->define(App\Models\KitchenIngredient::class, function (Faker $faker) {

    $title = $faker->sentence(rand(3, 5), true);

    $createdAt = $faker->dateTimeBetween('-3 months', '-2 months');

    return [
        'title' => $title,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];
});

