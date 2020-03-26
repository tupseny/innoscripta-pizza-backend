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
        factory(MenuGroup::class, rand(2, 5))->create()->each(function (MenuGroup $group){
           $group->meals()->createMany(
               factory(Meal::class, rand(1, 5))->make()->toArray()
           );
        });

//        Empty group
        factory(MenuGroup::class, rand(1,3))->create();

//        Meals without group
        factory(Meal::class, rand(2, 5))->create();
    }
}
