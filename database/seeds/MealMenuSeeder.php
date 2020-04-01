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
            new Meal(['name' => 'Farm', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)]),
            new Meal(['name' => 'Margarita', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)]),
            new Meal(['name' => 'Meat', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)]),
            new Meal(['name' => 'Olive', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)]),
            new Meal(['name' => 'Onion', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)]),
            new Meal(['name' => 'Sea', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)]),
            new Meal(['name' => 'Solyami', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)])
        ]);

        $drink->meals()->saveMany([
            new Meal(['name' => 'Cola', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)]),
            new Meal(['name' => 'Fanta', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)]),
            new Meal(['name' => 'Pepsi', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)]),
            new Meal(['name' => 'Sprite', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)]),
        ]);

        $snacks->meals()->saveMany([
            new Meal(['name' => 'Chips', 'price' => Faker\Provider\en_US\Payment::randomFloat(2, 1, 10)]),
        ]);

//        Empty group
        factory(MenuGroup::class, rand(1, 3))->create();

//        Meals without group
        factory(Meal::class, rand(2, 5))->create();
    }
}
