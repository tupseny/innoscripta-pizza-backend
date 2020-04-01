<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private function validateStore(Request $request)
    {
        return $request->validate(
            ['items' => 'required'],
            [
                '*.id' => 'required|numeric',
                '*.amount' => 'numeric|min:1',
            ]
        );
    }

    public function store(Request $request)
    {
        $data = $this->validateStore($request);
        $user = Auth::user();

        $order = new Order(['user_id' => $user['id']]);
        $order->save();

        $mealsAttachment = [];
        foreach ($data['items'] as $meal) {
            $mealsAttachment[$meal['id']] = ['amount' => $meal['amount']];
        }

        $order->meals()->attach($mealsAttachment);

        return ['success'];
    }

    public function index(){
        $user = Auth::user();

        $orders = [];
        foreach ($user->orders()->get() as $order){
            $meals = [];
            foreach ($order->meals()->get(['name', 'price']) as $meal) {
                array_push($meals, $meal);
            }
            array_push($orders, $meals);
//            $meals = array_map(function($meal){
//                return $meal['amount'] = $meal->pivot->amount;
//            }, $order->meals()->get('name', 'price'));

//            array_push($orders, $order->meals()->get('name', 'price'));
        }

        return $user->orders()->get()->map(function ($order){
            return $order->meals()->get()->map(function ($meal){
                return ["name" => $meal->name, "price" => $meal->price, "amount"=> $meal->pivot->amount];
            });
        });
//        {
//            return array_map(function ($meal){
//                return ["name" => $meal->name, "price" => $meal->price, "amount" => $meal->pivot->amount];
//            }, $order->meals()->get());
//        }, $user->orders()->get());
    }

    public function storeAnon(Request $request)
    {
        return ['success'];
    }
}
