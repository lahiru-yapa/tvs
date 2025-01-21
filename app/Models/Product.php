<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products'; // Optional if table name is 'customers'
    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'stock',
        'category',
        'supplier_id',
        'photo',
        'sell_price',
    ];
    
    public function invoices()
    {
        return $this->belongsTo(Shop::class);
    }


}
