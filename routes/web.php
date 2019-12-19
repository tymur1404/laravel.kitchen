<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/kitchen/admin/recipe/add_relation_recipe_ingredient', 'Kitchen\Admin\RecipeController@addRelationRecipeIngredient')
    ->name('kitchen.admin.recipes.add_relation_recipe_ingredient')->middleware('auth');

Route::patch('/kitchen/admin/recipe/update_recipe_ingredient_ajax', 'Kitchen\Admin\RecipeController@updateRecipeIngredientAjax')
    ->name('kitchen.admin.recipes.update_recipe_ingredient_ajax')->middleware('auth');

Route::patch('/kitchen/admin/recipe/update_quantity_ingredient_ajax', 'Kitchen\Admin\RecipeController@updateQuantityIngredientAjax')
    ->name('kitchen.admin.recipes.update_quantity_ingredient_ajax')->middleware('auth');

Route::delete('/kitchen/admin/recipe/delete_recipe_ingredient_ajax', 'Kitchen\Admin\RecipeController@deleteRecipeIngredientAjax')
    ->name('kitchen.admin.recipes.delete_recipe_ingredient_ajax')->middleware('auth');

Route::group(['namespace' => 'Kitchen', 'prefix' => 'kitchen'], function () {
    $methods = ['index', 'show'];
    Route::resource('recipes', 'RecipeController')
        ->only($methods)//только для этих методов
        ->names('kitchen.recipes');
});

$groupData = [
    'namespace' => 'Kitchen\Admin',
    'prefix' => 'kitchen/admin',
];

Route::group($groupData, function () {

    //Recipe
    Route::resource('recipe', 'RecipeController')
        ->names('kitchen.admin.recipes')->middleware('auth');

    //Ingredient
    Route::resource('ingredient','IngredientController')
        ->except(['show'])//кроме show
        ->names('kitchen.admin.ingredients')->middleware('auth');

});
