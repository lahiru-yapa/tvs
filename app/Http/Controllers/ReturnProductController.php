<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Payment;
use App\Models\Invoice;

class ReturnProductController extends Controller
{
    public function allReturns()
    {
        $products = Product::where('delete_flag', 0)->get();
        return view('Products.allProducts', compact('products'));
    }

    public function addReturns (Request $request)
    {
        $invoice = Invoice::with('shop')
        ->where('delete_flag', 0)
        ->get();
    
        return view('Returns.addReturn', compact('invoice'));
    }
}