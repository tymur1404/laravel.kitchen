<?php
/**
 * Created by PhpStorm.
 * User: timur
 * Date: 01.11.19
 * Time: 15:27
 */

namespace App\Repositories;

use App\Models\KitchenIngredientKitchenRecipe as Model;
use App\Models\KitchenRecipe;
use Illuminate\Database\Eloquent\Collection;

class KitchenIngredientKitchenRecipeRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getQuantitiesForIngredients($recipe_id)
    {

        $columns = [
            'kitchen_ingredient_id',
            'quantity',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->where('kitchen_recipe_id', $recipe_id)
            ->get();
        $result = $result->pluck('quantity', 'kitchen_ingredient_id');

        return $result;
    }

//    public function updateQuantityAjax($request)
//    {
//        $result =  $this->startConditions()::where('kitchen_recipe_id', $request->recipe_id)
//            ->where('kitchen_ingredient_id', '=', $request->ingredient_id)
//            ->update(['quantity' => $request->quantity]);
//        if($result){
//            $recipe = KitchenRecipe::find($request->recipe_id);
//            $recipe->saveUserChanges();
//            return true;
//        }
//        return false;
//    }
//
//    public function deleteQuantityAjax($request){
//        $result = $this->startConditions()::where('kitchen_recipe_id', $request->recipe_id)
//            ->where('kitchen_ingredient_id', '=', $request->ingredient_id)
//            ->delete();
//        if($result){
//            $recipe = KitchenRecipe::find($request->recipe_id);
//            $recipe->saveUserChanges();
//            return true;
//        }
//        return false;
//    }
}
