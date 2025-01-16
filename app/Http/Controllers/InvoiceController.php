<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Invoice; // Replace with your actual model

class InvoiceController extends Controller
{
      /**
     * Show the form for creating a new invoice.
     */
    public function addinvoice()
    {

        $shops = Shop::all();
        $user =  auth()->user()->name;
        $products = Product::all();

        return view('invoices.create', compact('shops', 'user', 'products'));
    }

    // Suggest products based on search query
    public function suggestProducts(Request $request)
    {
        $query = $request->get('query');
        $products = Product::where('name', 'like', '%' . $query . '%')
                           ->orWhere('sku', 'like', '%' . $query . '%')
                           ->pluck('name'); // Or you can return more data like SKU
        return response()->json($products);
    }

    // Fetch product details based on the selected product name
    public function getProductDetails(Request $request)
    {
    
        $productName = $request->get('product_name');
        $product = Product::where('name', $productName)->first();

        if ($product) {
            return response()->json([
                'id' => $product->id,
                'name' => $product->name,
                'amount' => $product->price,
                'stock' => $product->stock,
                'image' => asset('storage/' . $product->photo), // Assuming image is stored in storage
            ]);
        }
    
        return response()->json([], 404); // If product not found
    }

    // Store the selected products (multiple)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'selected_products' => 'required|array',
            'selected_products.*.name' => 'required|string',
            'selected_products.*.amount' => 'required|numeric',
            'selected_products.*.image' => 'required|url', // Assuming image is a URL
        ]);

        // Loop through the selected products and store them
        foreach ($validatedData['selected_products'] as $productData) {
            Product::create([
                'id' => $productData['id'],
                'name' => $productData['name'],
                'amount' => $productData['amount'],
                'image' => $productData['image'],
            ]);
        }

        return redirect()->route('product.index')->with('success', 'Products added successfully!');
    }

    public function storeInvoice(Request $request)
    {
       
        // Validate the request
        $validatedData = $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'payment_method' => 'required|string',
            'selected_products' => 'required|json', // Ensure it's valid JSON
             'counts' => 'required|array', // Ensure counts is an array
        ]);

        // Parse the selected products from JSON
        $selectedProducts = json_decode($validatedData['selected_products'], true);
     
        if (!$selectedProducts || !is_array($selectedProducts)) {
            return back()->withErrors(['selected_products' => 'Invalid product data.']);
        }
  

        // Check shop's credit limit if necessary
        $shop = Shop::find($validatedData['shop_id']);
        if ($shop && $shop->current_balance) {
            if ($request->totalAmount > $shop->current_balance) {
                return redirect()->back()->with('returnerror', 'Sorry Current balance : ' . $shop->current_balance);
            }
        }
        // Create the invoice
        $invoice = Invoice::create([
            'shop_id' => $validatedData['shop_id'],
            'user_id' => auth()->user()->id, 
            'payment_method' => $validatedData['payment_method'],
            'total_amount' => $request->totalAmount,
        ]);

        // Save products to the invoice
        foreach ($selectedProducts as $productData) {
            $invoice->products()->create([
                'product_id' => $productData['id'],
                'quantity' => $productData['count'],
                'price' => $productData['amount'],
            ]);
        }

        return redirect()->route('invoice.index')->with('success', 'Invoice created successfully.');
    }
}
