<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\GetProductsRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Product;

class ProductController extends Controller
{
    private function sort_products($products,$request){
          return ($request->has('sort_by'))
             ?  $products->OrderBy('price',$request->query('sort_by'))
             :  $products;

    }

    private function search_products($products,$request){
        return ($request->has('search_by'))
            ?  $products->search($request->query('search_by'))
            :  $products;

    }

    public function index(GetProductsRequest $request){
        $products=new Product;
        $products=$this->sort_products($products,$request);
        $products=$this->search_products($products,$request);
        //return new ProductCollection($products->paginate(10));
		return $products->get();
    }

    public function store(CreateProductRequest $request){
        Product::create($request->all());
        return response()->json(["message"=>"Created Successfully"]);
    }

    public function show(Product $ProductId){
        return response()->json($ProductId);
    }

    public function update(Product $ProductId,UpdateProductRequest $request){
       $ProductId->update($request->all());
       return response()->json(["message"=>"Updated Successfully"]);
    }

    public function destroy(Product $ProductId){
        $ProductId->delete();
        return response()->json(["message"=>"Deleted Successfully"]);
    }
}
