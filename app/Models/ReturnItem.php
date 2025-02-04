<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnItem extends Model
{
    use HasFactory;
    protected $primaryKey = 'return_item_id'; // Set primary key
    protected $fillable = [
        'return_id',
        'product_id',
        'quantity',
        'unit_price',
        'reason',
    ];

   

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Define relationships
    public function return()
    {
        return $this->belongsTo(ProductReturn::class, 'return_id');
    }
}
