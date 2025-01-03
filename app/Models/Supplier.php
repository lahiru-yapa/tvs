<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers'; // Optional if table name is 'customers'
    protected $fillable = [
        'name', 
        'address', 
        'contact_person', 
        'current_balance', 
        'phone', 
        'note',
        'email',
        'delete_flag',
        'credit_limit',
        'current_balance',
    ];
}