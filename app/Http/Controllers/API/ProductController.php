<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Validator;
use App\Models\Product;
use App\Http\Resources\Product as ProductResource;

class ProductController extends BaseController
{

      public function index()
    {
        $products = Product::all();
        return $this->sendResponse(ProductResource::collection($products), 'Products fetched.');
    }

    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $products = Product::create($input);
        return $this->sendResponse(new ProductResource($products), 'Product created.');
    }

   
    public function show($id)
    {
        $products = Product::find($id);
        if (is_null($products)) {
            return $this->sendError('Product does not exist.');
        }
        return $this->sendResponse(new ProductResource($products), 'Product fetched.');
    }
    

    public function update(Request $request, Product $product)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $product->name = $input['name'];
        $product->description = $input['description'];
        $product->save();
        
        return $this->sendResponse(new ProductResource($product), 'Product updated.');
    }
   
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->sendResponse([], 'Product deleted.');
    }
   

    
    
}
