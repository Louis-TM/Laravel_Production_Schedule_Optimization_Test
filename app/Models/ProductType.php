<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductType extends Model
{
    protected $fillable = [
        'type_name',
        'production_speed'
    ];

    public function products(): HasMany{
        return $this->hasMany(Product::class, 'product_type_id');
    }

    public function orders(): HasMany{
        return $this->hasMany(Order::class, 'product_type_id');
    }
}
