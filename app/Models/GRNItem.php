<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRNItem extends Model
{
    use HasFactory;
    protected $fillable = ['grn_id', 'product_id', 'quantity', 'unit_price', 'total_price','warranty_period'];

    public function grn()
    {
        return $this->belongsTo(GRN::class, 'grn_id'); // Explicitly define foreign key
    }
    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}

}
