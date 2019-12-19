<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\KitchenRecipe;
use App\Models\KitchenIngredient;
use App\Observers\KitchenRecipeObserver;
use App\Observers\KitchenIngredientObserver;

class KitchenServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        KitchenIngredient::observe(KitchenIngredientObserver::class);
        KitchenRecipe::observe(KitchenRecipeObserver::class);
    }
}
