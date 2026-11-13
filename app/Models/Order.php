<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'product_type_id',
        'need_by',
        'setup_delay_minutes',
        'scheduled_start_time',
        'scheduled_end_time',
    ];

    public function items(): HasMany{
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function productType(): BelongsTo{
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

}
