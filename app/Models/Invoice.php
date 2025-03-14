<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices'; // Optional if table name is 'customers'
    protected $fillable = [
        'shop_id',
        'user_id',
        'invoice_number',
        'total_amount',
        'paid_amount',
        'paid_status',
        'due_date',
        'invoice_date',
        'payment_date',
        'description',
        'warehouse_id',
    ];
    
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function productReturns()
    {
        return $this->hasMany(ProductReturn::class, 'invoice_id');
    }
      // Relationship: Invoice belongs to Warehouse
      public function warehouse()
      {
          return $this->belongsTo(Warehouse::class, 'warehouse_id');
      }

public function invoiceProducts()
{
    return $this->hasMany(InvoiceProduct::class);
}

    // Relationship to Payment
    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }
    
    // In the Invoice model
public function products()
{
    return $this->hasMany(InvoiceProduct::class);
}

}

