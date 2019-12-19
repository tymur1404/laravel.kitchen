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

$factory->define(App\Models\KitchenIngredientKitchenRecipe::class, function (Faker $faker) {


    $createdAt = $faker->dateTimeBetween('-3 months', '-2 months');

    return [
        'kitchen_ingredient_id' => rand(1,100),
        'kitchen_recipe_id' => rand(1,10),
        'quantity' => rand(1,15). ' шт.',
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
    ];
});

