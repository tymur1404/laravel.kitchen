<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitchenIngredientKitchenRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitchen_ingredient_kitchen_recipes', function (Blueprint $table) {
//            $table->bigIncrements('id');
            $table->bigInteger('kitchen_ingredient_id')->unsigned();
            $table->bigInteger('kitchen_recipe_id')->unsigned();

            $table->string('quantity');
            $table->timestamps();
            $table->foreign('kitchen_recipe_id')->references('id')
                ->on('kitchen_recipes')->onDelete('cascade');
            $table->foreign('kitchen_ingredient_id')->references('id')
                ->on('kitchen_ingredients')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kitchen_ingredient_kitchen_recipes');
    }
}
