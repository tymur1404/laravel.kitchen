<?php

namespace App\Observers;

use App\Models\KitchenRecipe;
use Illuminate\Support\Facades\Auth;

class KitchenRecipeObserver
{
    /**
     * Handle the kitchen recipe "created" event.
     *
     * @param  \\App\Models\KitchenRecipe $kitchenRecipe
     * @return void
     */
    public function created(KitchenRecipe $kitchenRecipe)
    {
        //
    }

    /**
     * Handle the kitchen recipe "updated" event.
     *
     * @param  \\App\Models\KitchenRecipe $kitchenRecipe
     * @return void
     */
    public function updated(KitchenRecipe $kitchenRecipe)
    {

    }

    /**
     * Handle the kitchen recipe "deleted" event.
     *
     * @param  \\App\Models\KitchenRecipe $kitchenRecipe
     * @return void
     */
    public function deleted(KitchenRecipe $kitchenRecipe)
    {
        $kitchenRecipe->ingredient()->detach();
        $this->setUserChanges($kitchenRecipe);
    }

    /**
     * Handle the kitchen recipe "restored" event.
     *
     * @param  \\App\Models\KitchenRecipe $kitchenRecipe
     * @return void
     */
    public function restored(KitchenRecipe $kitchenRecipe)
    {
        //
    }

    /**
     * Handle the kitchen recipe "force deleted" event.
     *
     * @param  \\App\Models\KitchenRecipe $kitchenRecipe
     * @return void
     */
    public function forceDeleted(KitchenRecipe $kitchenRecipe)
    {

    }

    public function setUserChanges($kitchenRecipe)
    {
        $kitchenRecipe->user_id = Auth::user()->id;
        $kitchenRecipe->save();
    }
}
