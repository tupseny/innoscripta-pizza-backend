<?php

namespace Tests\Feature;

use App\Meal;
use App\MenuGroup;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use function foo\func;

class MenuGroupControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Get all NON-EMPTY groups
     *
     * @return void
     */
    public function testIndex()
    {
        $oneMealGroup = factory(MenuGroup::class)->create();
        $oneMealGroup->meals()->createMany(
            factory(Meal::class, 1)->make()->toArray()
        );

        $tenMealGroup = factory(MenuGroup::class)->create();
        $tenMealGroup->meals()->createMany(
            factory(Meal::class, 10)->make()->toArray()
        );

        $emptyGroup = factory(MenuGroup::class)->create();

        $expectedJson =
            $oneMealGroup->whereId($oneMealGroup->id, $tenMealGroup->id)->get(['name', 'id'])->toArray();

        $expectedJsonStructure = [[
            'id', 'name'
        ]];

        $expectedMissingJson = $emptyGroup->toArray();

        $response = $this->json('GET', '/api/menu/');

        $response
            ->assertStatus(200) # OK
            ->assertJsonStructure($expectedJsonStructure)
            ->assertJson($expectedJson)
            ->assertJsonMissing($expectedMissingJson);
    }
}
