<?php

namespace App\Http\Controllers\Kitchen\Admin;

use App\Http\Requests\KitchenIngredientCreateRequest;
use App\Http\Requests\KitchenIngredientUpdateRequest;
use App\Models\KitchenIngredient;
use App\Repositories\KitchenIngredientKitchenRecipeRepository;
use App\Repositories\KitchenIngredientRepository;
use App\Repositories\KitchenRecipeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IngredientController extends BaseController
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
        $ingredients = $this->kitchenIngredientRepository->getAllWithPaginate();
        return view('kitchen.admin.ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredient = new KitchenIngredient();

        return view('kitchen.admin.ingredients.edit',
            compact('ingredient'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(KitchenIngredientCreateRequest $request)
    {
        $data = $request->input();
        if (isset($data['quantity'])) {

            $recipe_id = (int)$data['recipe_id'];
            $quantity = $data['quantity'];
            unset($data['quantity']);

            $ingredient = (new KitchenIngredient())->create($data);
            $this->kitchenIngredientRepository->addRelationIngredientRecipe($recipe_id, $ingredient->id, $quantity);

            return redirect()->route('kitchen.admin.recipes.edit', [$recipe_id])
                ->with(['success' => 'Успешно сохранено']);
        } else {

            (new KitchenIngredient())->create($data);
            $ingredients = $this->kitchenIngredientRepository->getAllWithPaginate();
            return view('kitchen.admin.ingredients.index', compact('ingredients') );
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingredient = $this->kitchenIngredientRepository->getIngredient($id);

        if (empty($ingredient)) {
            abort(404);//если не нашли модель то 404
        }

        return view('kitchen.admin.ingredients.edit',
            compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(KitchenIngredientUpdateRequest $request, $id)
    {
        $ingredient = $this->kitchenIngredientRepository->getIngredient($id);

        if (empty($ingredient)) {
            return back()
                ->withErrors(['msg' => "Record id = [ {$id} ] not found"])
                ->withInput();
        }

        $data = $request->all();


        $result = $ingredient->update($data);

        if($result){
            return redirect()
                ->route('kitchen.admin.ingredients.edit', $ingredient)
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
        $result = KitchenIngredient::destroy($id);
//        $ingredient = $this->kitchenIngredientRepository->deleteRecipeIngredient($id);

        if ($result) {
            return redirect()
                ->route('kitchen.admin.ingredients.index')
                ->with(['success' => "ID [ $id ] entry deleted"]);
        } else {
            return back()->withErrors(['msg' => 'Delete Error']);
        }
    }
}
