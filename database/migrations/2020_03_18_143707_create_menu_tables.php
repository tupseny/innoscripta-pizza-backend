<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createMenuGroup();
        $this->createMeal();
        $this->createIngredients();
        $this->createMealIngredient();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meal_ingredient');
        Schema::dropIfExists('ingredient');
        Schema::dropIfExists('meal');
        Schema::dropIfExists('menu_group');
    }

    /**
     *  Creates table MEAL_INGREDIENT
     *
     *  Contains meal composite
     *
     *  create ONLY after:
     *  MEAL, INGREDIENT
     */
    private function createMealIngredient(){
        Schema::create('meal_ingredient', function (Blueprint $t){
            $t->bigInteger('meal_id');
            $t->bigInteger('ingredient_id');
            $t->unsignedFloat('amount');
        });
    }

    /**
     *  Creates table INGREDIENT
     *
     *  Contains ingredients
     */
    private function createIngredients(){
        Schema::create('ingredient', function (Blueprint $t){
            $t->id();
            $t->string('name');
            $t->string('unit');
        });
    }

    /**
     *  Creates table MENU_GROUP
     *
     *  Contains menu categories (pizzas, drinks, ...)
     */
    private function createMenuGroup(){
        Schema::create('menu_group', function (Blueprint $t){
            $t->id();
            $t->string('name');
        });
    }

    /**
     *  Creates table MEAL.
     *
     *  Contains meals (pizzas, souses, ...) from menu
     *
     *  Create ONLY after:
     *  MENU_GROUP
     */
    private function createMeal(){
        Schema::create('meal', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->bigInteger('group_id');
            $t->float('price');
        });
    }
}
