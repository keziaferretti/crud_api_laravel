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

  public function rules()
  {
    return [
      'name' => 'required|string|min:3',
      'description' => 'required|string|min:3',
      'price' => 'required|numeric',
      'status_id' => 'required|numeric|exists:statuses,id',
      'stock_quantity' => 'integer|min:0',
    ];
  }

  public function messages()
  {
    return [
      'name.required' => 'Nome do produto é obrigatório',
      'name.min' => 'Nome do produto deve ter no mínimo 3 caracteres',
      'name.string' => 'Nome do produto deve ser uma string',

      'description.required' => 'Descrição do produto é obrigatória',
      'description.min' => 'Descrição do produto deve ter no mínimo 3 caracteres',
      
      'price.required' => 'Preço do produto é obrigatório',
      'price.numeric' => 'Preço do produto deve ser um número',

      'status_id.exists' => 'Status não existe na tabela de status, por favor, insira um status válido',
      'status_id.required' => 'Status do produto é obrigatório',
      'status_id.numeric' => 'Status do produto deve ser um número',

      'stock_quantity.integer' => 'Quantidade do produto deve ser um número inteiro',
      'stock_quantity.min' => 'Quantidade do produto deve ser no mínimo 0',

    ];
  }

  public function store(Request $request)
  {
    $validated = Validator::make($request->all(), $this->rules(), $this->messages());
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

    if ($product) {
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
    if ($product) {
      $validated = Validator::make($request->all(), $this->rules(), $this->messages());
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

    if ($product) {
      $product->delete();
      return response()->json([
        'message' => 'Product deleted successfully',
        'data' => 'Product deleted: ' . $id
      ], 200);
    }

    return response()->json([
      'message' => 'Product not found'
    ], 404);
  }
}
