<?php

namespace App\Http\Controllers\Kitchen\Admin;

use App\Http\Requests\KitchenRecipeCreateRequest;
use App\Http\Requests\KitchenRecipeUpdateRequest;
use App\Repositories\KitchenIngredientKitchenRecipeRepository;
use App\Repositories\KitchenIngredientRepository;
use App\Repositories\KitchenRecipeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KitchenRecipe;
use App\Models\KitchenIngredientKitchenRecipe;
use Illuminate\Support\Facades\Auth;

class RecipeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->kitchenRecipeRepository = app(KitchenRecipeRepository::class);
        $this->kitchenIngredientRepository = app(KitchenIngredientRepository::class);
        $this->kitchenIngredientKitchenRecipeRepository = app(KitchenIngredientKitchenRecipeRepository::class);
    }

    public function index()
    {
        $recipes = $this->kitchenRecipeRepository->getAllWithPaginate();
        return view('kitchen.admin.recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recipe = new KitchenRecipe();
        $ingredientList = $this->kitchenIngredientRepository->getForComboBox();

        return view('kitchen.admin.recipes.edit',
            compact('recipe', 'ingredientList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(KitchenRecipeCreateRequest $request)
    {
        $data = $request->input();
        $data['user_id'] = Auth::user()->id;
        $recipe = (new KitchenRecipe())->create($data);
        if($recipe){
            return redirect()->route('kitchen.admin.recipes.edit', [$recipe->id])
                ->with(['success' => 'Saved successfully']);
        }else{
            return back()->withErrors(['msg' => 'Save error'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = $this->kitchenRecipeRepository->getRecipe($id);
        $quantity = $this->kitchenIngredientKitchenRecipeRepository->getQuantitiesForIngredients($id);
        return view('kitchen.admin.recipes.show', compact('recipe', 'quantity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recipe = $this->kitchenRecipeRepository->getRecipe($id);
        $quantity = $this->kitchenIngredientKitchenRecipeRepository->getQuantitiesForIngredients($id);
        $ingredientList = $this->kitchenIngredientRepository->getForComboBox();


        if (empty($recipe)) {
            abort(404);//если не нашли модель то 404
        }

        return view('kitchen.admin.recipes.edit',
            compact('recipe', 'quantity', 'ingredientList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(KitchenRecipeUpdateRequest $request, $id)
    {
        $recipe = $this->kitchenRecipeRepository->getEdit($id);

        if (empty($recipe)) {
            return back()
                ->withErrors(['msg' => "Record id = [ {$id} ] not found"])
                ->withInput();
        }

        $data = $request->all();


        $result = $recipe->update($data);

        if($result){
            return redirect()
                ->route('kitchen.admin.recipes.edit', $recipe)
                ->with(['success' => 'Saved successfully']);
        } else {
            return back()
                ->withErrors(['msg' => 'Save error'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = KitchenRecipe::destroy($id);

        if ($result) {
            return redirect()
                ->route('kitchen.admin.recipes.index')
                ->with(['success' => "ID [ $id ] entry deleted"]);
        } else {
            return back()->withErrors(['msg' => 'Delete Error']);
        }
    }



    public function updateQuantityIngredientAjax(Request $request)
    {
        $recipe_id = (int)$request->recipe_id ;
        $ingredient_id = (int)$request->ingredient_id;
        $quantity = $request->quantity;

        $this->kitchenRecipeRepository->updateIngredientQuantity($recipe_id, $ingredient_id, $quantity);


    }

    public function updateRecipeIngredientAjax(Request $request)
    {
        $recipe_id = (int)$request->recipe_id ;
        $ingredient_id = (int)$request->ingredient_id;
        $prev_ingredient_id = (int)$request->prev_ingredient_id;

        $this->kitchenRecipeRepository->updateRelationIngredientRecipe($recipe_id, $ingredient_id, $prev_ingredient_id);
    }

    public function deleteRecipeIngredientAjax(Request $request)
    {
        $recipe_id = (int)$request->recipe_id ;
        $ingredient_id = (int)$request->ingredient_id;

        $this->kitchenRecipeRepository->deleteRecipeIngredient($recipe_id, $ingredient_id);
    }

    public function addRelationRecipeIngredient (Request $request)
    {

//        dd($request);
        $recipe_id = (int)$request->recipe_id ;
        $ingredient_id = (int)$request->ingredient_id;
        $quantity = $request->quantity;

        $this->kitchenRecipeRepository->addRelationIngredientRecipe($recipe_id, $ingredient_id, $quantity);

        return redirect()
            ->route('kitchen.admin.recipes.edit', [$recipe_id])
            ->with(['success' => "Ingredient successfully added"]);
    }
}
