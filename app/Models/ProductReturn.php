<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductReturn extends Model
{
    use HasFactory;
    protected $table = 'product_returns';

    protected $fillable = [
        'shop_id',
        'invoice_id',
        'return_date',
        'salable_status',
        'total_amount',
    ];

    public function returnItems(): HasMany
    {
        return $this->hasMany(ReturnItem::class, 'product_return_id');
    }

    public function invoice()
{
    return $this->belongsTo(Invoice::class, 'invoice_id');
}

}
