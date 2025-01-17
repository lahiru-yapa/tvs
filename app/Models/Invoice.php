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
    ];
    
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // In App\Models\Invoice.php
public function products()
{
    return $this->hasMany(InvoiceProduct::class); // Assuming the model is InvoiceProduct
}

public function invoiceProducts()
{
    return $this->hasMany(InvoiceProduct::class);
}

}

