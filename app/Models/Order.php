<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    public function products(): BelongsToMany
    {
        return $this->BelongsToMany(Product::class, 'products_orders',   'order_id', 'product_id');
    }
    public function users(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
