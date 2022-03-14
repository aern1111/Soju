<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function productCartCreate(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'required|string',
            'price' => 'required',
            'description' => 'string',
            'quantity' => 'required',
            'total' => 'required',
            'category' => 'required|string',
            'user_id' => 'required',


        ]);

        $product = Cart::create($validate);
        $response = [
            'product' => $product,
            'message' => 'Succsee'
        ];
        return response($response, 201);
    }

    public function productCartRead()
    {
        return Cart::with('users','users')->get();
    }

    public function productCartDelete($id)
    {
        Cart::destroy($id);

        $response = [
            'massage' => 'Success'
        ];
        return response($response, 200);
    }

    public function productCartCount(){
        return Cart::all()->count();
    }
}
