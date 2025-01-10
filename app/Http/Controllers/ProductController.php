<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;

class ProductController extends Controller
{
    public function allproducts()
    {
        $products = Product::where('delete_flag', 0)->get();
        return view('Products.allProducts', compact('products'));
    }

    public function addproduct (Request $request)
    {
        $supllier = Supplier::where('delete_flag', 0)->get();
        return view('Products.addProducts', compact('supllier'));
    }

    public function view($id)
    {
        $product = Product::findOrFail($id);
        $supplier = Supplier::findOrFail($product->supplier_id);
      
        return view('Products.viewProductsr', compact('product','supplier'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $supplier = Supplier::findOrFail($product->supplier_id);
        $allSuplliers = Supplier::where('delete_flag', 0)->get();
        return view('Products.editProducts', compact('product','supplier','allSuplliers'));
    }
    public function store(Request $request)
    {
    
            // Validation
            $request->validate([
                'price' => 'required|numeric|min:0',
                'sell_price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'category' => 'required|string',
                'supplier_id' => 'required|exists:suppliers,id',
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'description' => 'required|string',
                'name' => 'required|string',
            ]);

         // Handle file upload
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('product_photos', 'public');
            }

                // Store in the database
                Product::create([
                    'name'=> $request->name,
                    'sku' => 'PRD-' . strtoupper(substr($request->description, 0, 3)) . '-' . date('YmdHis'),
                    'price' => $request->price,
                    'stock' => $request->stock,
                    'category' => $request->category,
                    'supplier_id' => $request->supplier_id, // Initial balance is the credit limit
                    'photo' => $photoPath, 
                    'sell_price'=>$request->sell_price,
                    'description'=>$request->description,
                ]);
          
                return redirect()->route('allproduct')->with('success', 'Shop created successfully!');

            
    }

    public function editProduct(Request $request)
    {
       
         // Validation
         $request->validate([
            'price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'supplier_id' => 'required|exists:suppliers,id',
            'description' => 'required|string',
            'name' => 'required|string',
        ]);
      
        
        $product = Product::find($request->Product_id); // Replace `user_id` with the actual field you're using
        //  // Handle file upload
        //  $photoPath = null;
        //  if ($request->hasFile('photo')) {
        //      $photoPath = $request->file('photo')->store('product_photos', 'public');
        //  }
        // Update the user details
        if ($product) {
            $product->update([
                    'name'=> $request->name,
                    'sku' => 'PRD-' . strtoupper(substr($request->description, 0, 3)) . '-' . date('YmdHis'),
                    'price' => $request->price,
                    'stock' => $request->stock,
                    'category' => $request->category,
                    'supplier_id' => $request->supplier_id, // Initial balance is the credit limit
                    'photo' => $request->photo, 
                    'sell_price'=>$request->sell_price,
                    'description'=>$request->description,
            ]);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
      
        return redirect()->route('allproduct')->with('success', 'Shop created successfully!');
    }

     
    public function delete($id)
    {
        try {
            // Find the user by ID
            $product = Product::findOrFail($id);
    
            // Set delete_flag to 1
            $product->delete_flag = 1;
            $product->save();
    
            // Redirect back with success message
            return redirect()->route('allproduct')->with('success', 'User flagged as deleted successfully!');
        } catch (\Exception $e) {
            // Handle exceptions (e.g., user not found)
            return redirect()->route('allproduct')->with('error', 'User could not be flagged as deleted.');
        }
    }
}