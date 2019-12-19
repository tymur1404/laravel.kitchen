<?php

namespace App\Http\Controllers\Kitchen;

use App\Models\KitchenRecipe;
use App\Repositories\KitchenIngredientKitchenRecipeRepository;
use App\Repositories\KitchenRecipeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecipeController extends BaseController
{

    public function __construct()
    {
        $this->kitchenRecipeRepository = app(KitchenRecipeRepository::class);
        $this->kitchenIngredientKitchenRecipeRepository = app(KitchenIngredientKitchenRecipeRepository::class);
    }

    public function index()
    {
        $recipes = $this->kitchenRecipeRepository->getAllWithPaginate();
        return view('kitchen.recipes.index', compact('recipes'));
    }

    public function show($id)
    {
        $recipe = $this->kitchenRecipeRepository->getRecipe($id);
        $quantity = $this->kitchenIngredientKitchenRecipeRepository->getQuantitiesForIngredients($id);
        return view('kitchen.recipes.show', compact('recipe','quantity' ));
    }
}
