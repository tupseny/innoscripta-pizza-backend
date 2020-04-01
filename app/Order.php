<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id'];

    public function meals(){
        return $this->belongsToMany(Meal::class, 'order_meal')->withPivot('amount');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
