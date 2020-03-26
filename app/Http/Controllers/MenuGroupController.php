<?php

namespace App\Http\Controllers;

use App\MenuGroup;
use Illuminate\Http\Request;

class MenuGroupController extends Controller
{
    const MENU_GROUP_COLS = ['id', 'name'];

    /**
     * Get all menu groups (not empty)
     *
     * @return MenuGroup[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return MenuGroup::all(self::MENU_GROUP_COLS)
            ->filter(function (MenuGroup $group) {
                return $group->meals()->count() > 0 ? true : false;
            })->values();
    }


    public function show($id)
    {
        return MenuGroup::findOrFail($id)->meals()->get(['name', 'price', 'id']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
