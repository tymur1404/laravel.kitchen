<?php

namespace App\Observers;

use App\Models\KitchenIngredient;
use App\Repositories\KitchenIngredientRepository;
use App\Models\KitchenRecipe;
use Illuminate\Support\Facades\Auth;

class KitchenIngredientObserver
{
    /**
     * Handle the kitchen ingredient "created" event.
     *
     * @param  \App\KitchenIngredient $kitchenIngredient
     * @return void
     */
    public function created(KitchenIngredient $kitchenIngredient)
    {
        //
    }

    /**
     * Handle the kitchen ingredient "updated" event.
     *
     * @param  \App\KitchenIngredient $kitchenIngredient
     * @return void
     */
    public function updated(KitchenIngredient $kitchenIngredient)
    {
        //
    }

    /**
     * Handle the kitchen ingredient "deleted" event.
     *
     * @param  \App\KitchenIngredient $kitchenIngredient
     * @return void
     */
    public function deleted(KitchenIngredient $kitchenIngredient)
    {
        $kitchenIngredient->recipe()->detach();
    }

    /**
     * Handle the kitchen ingredient "restored" event.
     *
     * @param  \App\KitchenIngredient $kitchenIngredient
     * @return void
     */
    public function restored(KitchenIngredient $kitchenIngredient)
    {
        $this->setUserChanges($kitchenIngredient->recipe_id);

    }


    /**
     * Handle the kitchen ingredient "force deleted" event.
     *
     * @param  \App\KitchenIngredient $kitchenIngredient
     * @return void
     */
    public function forceDeleted(KitchenIngredient $kitchenIngredient)
    {
        //
    }

    public function setUserChanges($recipe_id)
    {
        $recipe = KitchenRecipe::find($recipe_id);
        $recipe->user_id = Auth::user()->id;
        $recipe->save();
    }
}
