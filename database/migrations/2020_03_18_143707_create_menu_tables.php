<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTables extends Migration
{
    const MEAL_KEY = 'meals';
    const MENU_GROUP_KEY = 'menu_groups';
    const INGREDIENT_KEY = 'ingredients';
    const MEAL_INGREDIENT_KEY = 'meal_ingredient';

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
        Schema::dropIfExists(self::MEAL_INGREDIENT_KEY);
        Schema::dropIfExists(self::INGREDIENT_KEY);
        Schema::dropIfExists(self::MEAL_KEY);
        Schema::dropIfExists(self::MENU_GROUP_KEY);
    }

    /**
     *  Creates table MEAL_INGREDIENT
     *
     *  Contains meal composite
     *
     *  create ONLY after:
     *  MEAL, INGREDIENT
     */
    private function createMealIngredient()
    {
        Schema::create(self::MEAL_INGREDIENT_KEY, function (Blueprint $t) {
            $t->unsignedBigInteger('meal_id');
            $t->unsignedBigInteger('ingredient_id')->nullable();
            $t->unsignedFloat('amount');

            $t->primary(['meal_id', 'ingredient_id']);
            $t->foreign('meal_id')
                ->references('id')
                ->on(self::MEAL_KEY)
                ->onDelete('cascade');

            $t->foreign('ingredient_id')
                ->references('id')
                ->on(self::INGREDIENT_KEY)
                ->onDelete('set null');
        });
    }

    /**
     *  Creates table INGREDIENT
     *
     *  Contains ingredients
     */
    private function createIngredients()
    {
        Schema::create(self::INGREDIENT_KEY, function (Blueprint $t) {
            $t->id()->primary();
            $t->string('name');
            $t->string('unit');
        });
    }

    /**
     *  Creates table MENU_GROUP
     *
     *  Contains menu categories (pizzas, drinks, ...)
     */
    private function createMenuGroup()
    {
        Schema::create(self::MENU_GROUP_KEY, function (Blueprint $t) {
            $t->id()->primary();
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
    private function createMeal()
    {
        Schema::create(self::MEAL_KEY, function (Blueprint $t) {
            $t->id()->primary();
            $t->string('name');
            $t->unsignedBigInteger('group_id')->index();
            $t->float('price');

            $t->foreign('group_id')
                ->references('id')
                ->on(self::MENU_GROUP_KEY)
                ->onDelete('restrict');
        });
    }
}
