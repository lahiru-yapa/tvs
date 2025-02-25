<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GRN extends Model
{
    use HasFactory;
    protected $fillable = ['grn_number', 'warehouse_id', 'received_date', 'supplier_id', 'remarks'];

    public function items()
    {
        return $this->hasMany(GRNItem::class, 'grn_id'); // Explicitly define foreign key
    }

     // Relationship: GRN belongs to a Warehouse
     public function warehouse()
     {
         return $this->belongsTo(Warehouse::class, 'warehouse_id');
     }
 
     public function supplier()
     {
         return $this->belongsTo(Supplier::class, 'supplier_id');
     }
}
