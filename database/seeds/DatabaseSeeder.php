<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class,3)->create();
        factory(\App\Models\KitchenIngredient::class,100)->create();
        factory(\App\Models\KitchenRecipe::class,10)->create();
        factory(\App\Models\KitchenIngredientKitchenRecipe::class,50)->create();
    }
}
