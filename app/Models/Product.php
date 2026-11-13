<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Product extends Model
{
    protected $fillable = [
        'product_type_id',
        'product_name'
    ];

    public function productType(): BelongsTo{
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function orderItems(): HasMany{
        return $this->hasMany(OrderItem::class, 'product_id');
    }
}
