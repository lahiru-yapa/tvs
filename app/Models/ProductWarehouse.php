<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWarehouse extends Model
{
    use HasFactory;
    protected $table = 'product_warehouse'; // Define the pivot table name

    protected $fillable = ['product_id', 'warehouse_id', 'stock'];

    public $timestamps = true;

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relationship with Warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
