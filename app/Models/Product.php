<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_price',
        'size',
        'type_price',
        'type'

    ];


    public function cart(): BelongsToMany
    {
        return $this->BelongsToMany(Cart::class, 'product_cart', 'product_id', 'cart_id');
    }
    public function order(): HasMany
    {
        return $this->HasMany(Order::class, 'user_id');
    }
}
