<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class Apicontroller extends Controller
{
    //
    public function index( Request  $request){
        // lấy ra toàn bộ dl
       return response()->json(Product::all());
    }
    public function getProduct($id){
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(['message' => 'Product Not found'], 404);

        }
        return response()->json($product, 200);
    }
    public function addProduct(Request $request){
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }
    public function updateProduct( Request $request,$id){
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(['message' => 'Product Not found'], 404);
        }
        $product->update($request->all());
        return response()->json($product, 200);
    }
    public function deleteProduct( Request $request,$id){
        $product = Product::find($id);
        if(is_null($product)){
            return response()->json(['message' => 'Product Not found'], 404);
        }
        Product::find($id)->delete();
        return response()->json(null, 204);
    }
}
