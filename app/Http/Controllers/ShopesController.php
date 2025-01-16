<?php

namespace App\Http\Controllers;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopesController extends Controller
{
    public function allshopes()
    {
        $shops = Shop::where('delete_flag', 0)->get();
        return view('Shopes.allShopes', compact('shops'));
    }

    public function addshopes()
    {
        return view('Shopes.addShopes');
    }
    
    public function getShopCreditLimit(Request $request)
{
 
    $shop = Shop::find($request->shop_id); // Adjust the model name if it's different
    if ($shop) {
        return response()->json(['credit_limit' => $shop->credit_limit]);
    }
    return response()->json(['error' => 'Shop not found'], 404);
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


    public function edit($id)
    {
        $shop = Shop::findOrFail($id);
        return view('Shopes.shopedit', compact('shop'));
    }

    public function editShopstore(Request $request)
    {  
        $request->validate([
            'first_name' => 'required|string|max:255',
            'credit_limit' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'city' => 'required|string|max:255',
        ]);
   
    
        $user = Shop::find($request->shop_id); // Replace `user_id` with the actual field you're using

        // Update the user details
        if ($user) {
            $user->update([
                'name' => $request->first_name,
                'phone' => $request->phone,
                'address' => $request->city, // Updating address with `city`
                'credit_limit' => $request->credit_limit,
            ]);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
      
        return redirect()->route('allshopes')->with('success', 'Shop created successfully!');
    }
    
    public function delete($id)
    {
        try {
            // Find the user by ID
            $shop = Shop::findOrFail($id);
    
            // Set delete_flag to 1
            $shop->delete_flag = 1;
            $shop->save();
    
            // Redirect back with success message
            return redirect()->route('allshopes')->with('success', 'User flagged as deleted successfully!');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., user not found)
            return redirect()->route('allshopes')->with('error', 'User could not be flagged as deleted.');
        }
    }


    public function getAverageDays(Request $request)
{
    $shopId = $request->query('shop_id');
    $shop = Shop::find($shopId);

    if (!$shop) {
        return response()->json(['error' => 'Shop not found'], 404);
    }

    $averageDaysDifference = $shop->average_days_difference; // Accessor in the Shop model
    return response()->json(['averageDaysDifference' => $averageDaysDifference]);
}

}