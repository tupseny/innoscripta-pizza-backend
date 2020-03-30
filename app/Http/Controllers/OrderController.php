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

    public function storeAnon(Request $request)
    {
        return ['success'];
    }
}
