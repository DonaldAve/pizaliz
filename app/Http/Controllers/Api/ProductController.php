<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProductController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ProductResource::collection(Product::all());
    }

    public function store(StoreProductRequest $request): ProductResource
    {
        $product = new Product($request->validated());
        $product->save();
        return new ProductResource($product);
    }

    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
    public function update(Request $request, Product $product): ProductResource
    {



        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'name_price' => 'sometimes|numeric|min:0',

        ]);

        $product->update($validated);


        return new ProductResource($product->fresh()); // fresh() перезагружает модель из БД
    }
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
            'deleted_product' => new ProductResource($product)
        ], 200);
    }





}
