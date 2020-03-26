<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
           '*.id' => 'required|numeric',
            '*.amount' => 'numeric|min:0',
        ]);

        return response()->json(['success']);
    }
}
