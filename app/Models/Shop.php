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
    ];
}
