<?php
/**
 * Created by PhpStorm.
 * User: timur
 * Date: 01.11.19
 * Time: 15:27
 */

namespace App\Repositories;

use App\Models\KitchenIngredient as Model;
use Illuminate\Database\Eloquent\Collection;

class KitchenIngredientRepository extends CoreRepository
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

        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('title', 'asc')
            ->paginate(10);

        return $result;
    }

    public function getIngredient($id)
    {

        $columns = [
            'id',
            'title',
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->where('id',$id)
            ->first();
        return $result;
    }



    public function getForComboBox()
    {
        $columns = ['id', 'title'];
        $result = $this
            ->startConditions()
            ->select($columns)
            ->toBase()
            ->get();

        return($result);
    }

    public function addRelationIngredientRecipe($recipe_ID, $ingredientID,$quantity)
    {
        $ingredient = $this->startConditions()::find($ingredientID);
        $ingredient->recipe()->attach($recipe_ID, ['quantity' => $quantity]);
    }


}
