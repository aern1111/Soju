<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productCreate(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:100',
            'image' => 'required|string',
            'price' => 'required',
            'description' => 'string',
            'amount' => 'required',
            'category' => 'required|string',

        ]);

        $product = Product::create($validate);
        $response = [
            'product' => $product,
            'message' => 'Succsee'
        ];
        return response($response, 201);
    }

    public function productRead()
    {
        return Product::all();
    }

    public function productReadID($id)
    {
        return Product::find($id);
    }

    public function productSearch($keyword)
    {
        return Product::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('price', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orWhere('amount', 'like', '%' . $keyword . '%')
            ->orWhere('category', 'like', '%' . $keyword . '%')
            ->get();
    }

    public function productUpdate(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        $response = [
            'product' => $product,
            'message' => 'Success'
        ];
        return response($response, 201);
    }

    public function productDelete($id)
    {
        Product::destroy($id);

        $response = [
            'massage' => 'Success'
        ];
        return response($response, 200);
    }

    public function productCount()
    {
        return Product::all()->count();
    }

    public function productReadTree()
    {
        return Product::limit(6)->get();
    }
}
