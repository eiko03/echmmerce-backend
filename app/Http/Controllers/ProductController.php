<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\GetProductsRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(GetProductsRequest $request){
        $products=new Product;
        if ($request->has('sort_by'))
            $products=$products::OrderBy('price',$request->query('sort_by'));
        if ($request->has('search_by'))
            $products->search($request->query('search_by'));
        return new ProductCollection($products->paginate(10));
    }

    public function store(CreateProductRequest $request){
        Product::create($request->all());
        return response()->json(["message"=>"Created Successfully"]);
    }

    public function show($ProductId){
        return new ProductResource(Product::findOrFail($ProductId));
    }

    public function update($ProductId,UpdateProductRequest $request){
       Product::findOrFail($ProductId)->update($request->all());
       return response()->json(["message"=>"Updated Successfully"]);
    }

    public function destroy($ProductId){
        Product::destroy($ProductId);
        return response()->json(["message"=>"Deleted Successfully"]);
    }
}
