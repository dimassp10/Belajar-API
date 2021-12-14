<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    
    public function index()
    {
        return Product::all();
    }

    public function create(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        return $product;

    }

    public function show($id)
    {
       $product = Product::whereId($id)->first();
        return $product;
    }

    
    public function update(Request $request, $id)
    {
        $name = $request->name;
        $description = $request->description;

        $product = Product::find($id);
        $product->name = $name;
        $product->description =$description;
        $product->save();

        return "update berhasil";
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return "delete berhasil"; 
    } 
}
