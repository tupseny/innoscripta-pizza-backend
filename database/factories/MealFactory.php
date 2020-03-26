<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Meal;
use Faker\Generator as Faker;

$factory->define(Meal::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(200, 1000),
        'menu_group_id' => function () {
            return factory(App\MenuGroup::class)->create()->id;
        }
    ];
});
