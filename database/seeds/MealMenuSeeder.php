<?php

use App\Meal;
use App\MenuGroup;
use Illuminate\Database\Seeder;

class MealMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizza = new MenuGroup([
            'name' => 'Pizza',
        ]);
        $pizza->save();

        $drink = new MenuGroup([
            'name' => 'Drink',
        ]);
        $drink->save();

        $snacks = new MenuGroup([
            'name' => 'Snacks',
        ]);
        $snacks->save();

        $pizza->meals()->saveMany([
            new Meal(['name' => 'Farm']),
            new Meal(['name' => 'Margarita']),
            new Meal(['name' => 'Meat']),
            new Meal(['name' => 'Olive']),
            new Meal(['name' => 'Onion']),
            new Meal(['name' => 'Sea']),
            new Meal(['name' => 'Solyami'])
        ]);

        $drink->meals()->saveMany([
            new Meal(['name' => 'Cola']),
            new Meal(['name' => 'Fanta']),
            new Meal(['name' => 'Pepsi']),
            new Meal(['name' => 'Sprite']),
        ]);

        $snacks->meals()->saveMany([
            new Meal(['name' => 'Chips']),
        ]);

//        Empty group
        factory(MenuGroup::class, rand(1,3))->create();

//        Meals without group
        factory(Meal::class, rand(2, 5))->create();
    }
}
