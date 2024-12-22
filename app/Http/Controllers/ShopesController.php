<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopesController extends Controller
{
    public function allshopes()
    {
        return view('Shopes.allShopes');

    }

    public function addshopes()
    {
        return view('Shopes.addShopes');
    }
    

    public function store(Request $request)
    {
        
        // Validation
        $request->validate([
            'first_name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'city' => 'required|string|max:255',
            'credit_limit' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:255',
        ]);
       
        // Store in the database
        Shop::create([
            'name' => $request->first_name,
            'address' => $request->city,
            'credit_limit' => $request->credit_limit,
            'current_balance' => $request->credit_limit, // Initial balance is the credit limit
            'phone' => $request->phone, // If you decide to add a phone field in the database
            'note' => $request->note,
        ]);

        return redirect()->route('allshopes')->with('success', 'Shop created successfully!');

    }
}