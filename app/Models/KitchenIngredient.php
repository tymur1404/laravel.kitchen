<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KitchenIngredient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'quantity',

    ];

    public function recipe()
    {
        return $this->belongsToMany(KitchenRecipe::class,
            'kitchen_ingredient_kitchen_recipes',
            'kitchen_ingredient_id', 'kitchen_recipe_id');
    }


}
