<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    protected $table = 'shops'; // Optional if table name is 'customers'
    protected $fillable = [
        'name', 
        'address', 
        'credit_limit', 
        'current_balance', 
        'phone', 
        'note',
        'delete_flag',
    ];

     // Define the relationship with invoices (assuming one-to-many relationship)
     public function invoices()
     {
         return $this->hasMany(Invoice::class);
     }
 
     // Define the accessor to calculate the average days difference
     public function getAverageDaysDifferenceAttribute()
     {
       
         $invoices = $this->invoices;  // Get all invoices for the shop
        
         if ($invoices->isEmpty()) {
             return 0;  // Return 0 if there are no invoices
         }
 
         $totalDays = 0;
         $invoiceCount = 0;
      
         // Loop through invoices to calculate days difference
         foreach ($invoices as $invoice) {
             if ($invoice->invoice_date && $invoice->payment_date) {
                 $daysDifference = Carbon::parse($invoice->payment_date)->diffInDays(Carbon::parse($invoice->invoice_date));
                 $totalDays += $daysDifference;
                 $invoiceCount++;
             }
         }
   
 
         // Calculate average days difference
         return $invoiceCount > 0 ? $totalDays / $invoiceCount : 0;
     }
}
