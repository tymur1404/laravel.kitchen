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

$factory->define(App\Models\KitchenRecipe::class, function (Faker $faker) {

    $title = $faker->sentence(rand(3, 8), true);
    $txt = $faker->realText(rand(1000, 4000));

    $createdAt = $faker->dateTimeBetween('-3 months', '-2 months');

    return [
        'user_id' => (rand(1, 5) == 5) ? 1 : 2,
        'title' => $title,
        'description' => $txt,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];
});

