<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'description']; // Only necessary fields

    public function grns()
    {
        return $this->hasMany(GRN::class, 'supplier_id');
    }
}
