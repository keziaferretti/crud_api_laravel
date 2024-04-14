<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

  public function index()
  {
    $product = ProductResource::collection(Product::with('status')->get());

    return response()->json([
      'message' => 'Successful Product Listing',
      'data' => $product
    ], 200);
  }


  public function store(Request $request)
  {
    $validated = Validator::make($request->all(), [
      'name' => 'required|string|min:3',
      'description' => 'required|string|min:3',
      'price' => 'required|numeric',
      'status_id' => 'required|numeric|exists:statuses,id',
      'stock_quantity' => 'integer'
    ]);
    if ($validated->fails()) {
      return response()->json([
        'message' => 'Validation Error',
        'errors' => $validated->errors()
      ], 400);
    }

    $product = Product::create($request->all());
    if ($product) {
      return response()->json([
        'message' => 'Product created successfully',
        'data' => new ProductResource($product->load('status'))
      ], 201);
    }

    return response()->json([
      'message' => 'Error in creating product'
    ], 500);
  }


  public function show(string $id)
  {
    $product = Product::find($id);

    if($product){
      return response()->json([
        'message' => 'Successful Product Listing',
        'data' => new ProductResource($product->load('status'))  
      ], 200);
    }

    return response()->json([
      'message' => 'Product not found'
    ], 404);
  }

  public function update(Request $request, string $id)
  {

    $product = Product::find($id);
    if($product){
      $validated = Validator::make($request->all(), [
        'name' => 'required|string|min:3',
        'description' => 'required|string|min:3',
        'price' => 'required|numeric',
        'status_id' => 'required|numeric|exists:statuses,id',
        'stock_quantity' => 'integer'
      ]);
      if ($validated->fails()) {
        return response()->json([
          'message' => 'Validation Error',
          'errors' => $validated->errors()
        ], 400);
      }

      $product->update($request->all());

      return response()->json([
        'message' => 'Product updated successfully',
        'data' => new ProductResource($product->load('status'))
      ], 200);
    }

    return response()->json([
      'message' => 'Product not found'
    ], 404);
  }

  public function destroy(string $id)
  {
    $product = Product::find($id);

    if($product){
      $product->delete();
      return response()->json([
        'message' => 'Product deleted successfully',
        'data' => 'Product deleted: '.$id
      ], 200);
    }

    return response()->json([
      'message' => 'Product not found'
    ], 404);
  }
}
