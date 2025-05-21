<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        return CartResource::collection(Cart::all());
    }
}
