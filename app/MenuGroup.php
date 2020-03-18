<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuGroup extends Model
{
    protected $fillable = ['name'];

    /**
     *  Get all meals related to current MenuGroup
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meals()
    {
        return $this->hasMany(Meal::class)->orderBy('name');
    }
}
