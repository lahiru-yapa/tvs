<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'amount', 'expense_date', 'description', 'added_by'];

   public function user()
    {
        return $this->belongsTo(User::class);
    }
}
