<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class KitchenRecipe extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'user_id',
    ];

    public function ingredient()
    {
        return $this->belongsToMany(KitchenIngredient::class,
            'kitchen_ingredient_kitchen_recipes',
            'kitchen_recipe_id', 'kitchen_ingredient_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class); //отношение post.user_id -> user.id
    }


}
