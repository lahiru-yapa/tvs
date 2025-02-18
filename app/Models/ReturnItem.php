<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ReturnItem extends Model
{
    use HasFactory;
    protected $table = 'return_items';

    protected $fillable = [
        'product_return_id',
        'product_id',
        'quantity',
        'salable_status',
        'reason',
        'return_amount',
    ];

    public function productReturn(): BelongsTo
    {
        return $this->belongsTo(ProductReturn::class, 'product_return_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

 
}
