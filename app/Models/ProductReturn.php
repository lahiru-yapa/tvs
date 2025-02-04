<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReturn extends Model
{
    use HasFactory;
    protected $primaryKey = 'return_id'; // Set primary key
    protected $fillable = [
        'invoice_id',
        'shop_id',
        'return_date',
        'return_reason',
        'status',
        'total_amount',
    ];

    // Define relationships
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id');
    }

    public function returnItems()
    {
        return $this->hasMany(ReturnItem::class, 'return_id');
    }
}
