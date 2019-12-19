<?php
/**
 * Created by PhpStorm.
 * User: timur
 * Date: 01.11.19
 * Time: 15:27
 */

namespace App\Repositories;

use App\Models\KitchenRecipe as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class KitchenRecipeRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAllWithPaginate()
    {

        $columns = [
            'id',
            'title',
            'description',
            'user_id',
            'created_at',

        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('title', 'asc')
            ->with(['user:id,name',])//для lazy load(жадной загрузки). Указать в модели "return $this->belongsTo()" выбрали по два поля из каждой таблицы
            ->paginate(5);

        return $result;
    }

    public function getRecipe($id)
    {

        $columns = [
            'id',
            'title',
            'description',
            'user_id',
            'created_at',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->where('id', $id)
            ->with(['ingredient:id,title', 'user:id,name'])//для lazy load(жадной загрузки). Указать в модели "return $this->belongsTo()" выбрали по два поля из каждой таблицы
            ->first();
        return $result;
    }

    public function saveUserChanges($id)
    {
        $recipe = $this->startConditions()->find($id);
        $recipe->user_id = Auth::user()->id;
        $recipe->save();
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function addRelationIngredientRecipe($recipe_ID, $ingredientIDs,$quantity)
    {
        $recipe = $this->startConditions()::find($recipe_ID);
        $recipe->ingredient()->attach($ingredientIDs, ['quantity' => $quantity]);
        $this->saveUserChanges($recipe_ID);
    }

    public function updateIngredientQuantity($recipe_ID, $ingredientIDs,$quantity)
    {
        $recipe = $this->startConditions()::find($recipe_ID);
        $recipe->ingredient()->updateExistingPivot($ingredientIDs, ['quantity' => $quantity]);
        $this->saveUserChanges($recipe_ID);
    }

    public function updateRelationIngredientRecipe($recipe_ID, $ingredientIDs,$prev_ingredient_id)
    {
        $recipe = $this->startConditions()::find($recipe_ID);
        $recipe->ingredient()->updateExistingPivot($prev_ingredient_id, ['kitchen_ingredient_id' => $ingredientIDs]);
        $this->saveUserChanges($recipe_ID);
    }

}
