<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use http\Env\Request;

class CartController extends Controller
{
    public function index()
    {
        return CartResource::collection(Cart::all());
    }
    public function show(Cart $cart)
    {
        return new CartResource($cart);
    }
    public function store(StoreCartRequest $request)
    {
        $cart = new Cart($request->validated());
        $cart->save();
        return new CartResource($cart);
    }
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
            'deleted_product' => new OrderResource($cart)
        ], 200);
    }

    public function update(\Illuminate\Http\Request $request, Cart $cart): CartResource
    {
        $validated = $request->validate([

            'product_id' => '',

        ]);
        $cart->update($validated);


        return new CartResource($cart->fresh());
    }
}
