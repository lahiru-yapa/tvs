<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function allsuppliers()
    {
        $supllier = Supplier::where('delete_flag', 0)->get();
        // Fetch all users  
        return view('Supllier.allSupllier', compact('supllier'));
    }

    public function addsuppliers (Request $request)
    {
        return view('Supllier.addSupplier');
    }
    
    
    public function store(Request $request)
    {
 
      $request->validate([
        'first_name' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'contact_person' => 'required|string|max:255',
        'phone' => 'required|numeric|digits_between:10,15',
        'note' => 'nullable|string|max:500',
    ]);
    
        // Store in the database
        Supplier::create([
            'name' => $request->first_name,
            'phone' => $request->phone,
            'address' => $request->city,
            'credit_limit' => $request->credit_limit,
            'email' => $request->email,
            'note' => $request->note,
            'contact_person' => $request->contact_person,

        ]);
      
        return redirect()->route('allsuppliers')->with('success', 'Shop created successfully!');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('Supllier.editSupllier', compact('supplier'));
    }

    public function view($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('Supllier.viewSupplier', compact('supplier'));
    }
  
    public function editSuppliers(Request $request)
    {
    
        $request->validate([
            'first_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'note' => 'nullable|string|max:500',
        ]);
        
    
        $supplier = Supplier::find($request->user_id); // Replace `user_id` with the actual field you're using

        // Update the user details
        if ($supplier) {
            $user->update([
                'name' => $request->first_name,
                'phone' => $request->phone,
                'address' => $request->city, // Updating address with `city`
                'credit_limit' => $request->credit_limit,
                'email' => $request->email,
                'contact_person' => $request->contact_person,
                'note' => $request->note,
            ]);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
      
        return redirect()->route('allsuppliers')->with('success', 'Shop created successfully!');
    }
    
    public function delete($id)
{
    try {
        // Find the user by ID
        $supplier = Supplier::findOrFail($id);

        // Set delete_flag to 1
        $supplier->delete_flag = 1;
        $supplier->save();

        // Redirect back with success message
        return redirect()->route('allsuppliers')->with('success', 'User flagged as deleted successfully!');
    } catch (\Exception $e) {
        // Handle exceptions (e.g., user not found)
        return redirect()->route('allsuppliers')->with('error', 'User could not be flagged as deleted.');
    }
}

}
