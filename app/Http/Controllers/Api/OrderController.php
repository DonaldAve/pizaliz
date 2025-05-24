<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::all());
    }
    public function show(Cart $cart)
    {

        if ($cart->user_id !== auth()->id()) {
            abort(403, 'У вас нет доступа к этой корзине');
        }

        return new CartResource($cart);
    }
}
