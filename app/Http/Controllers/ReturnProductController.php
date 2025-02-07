<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Payment;
use App\Models\InvoiceProduct; 
use App\Models\Invoice;
use App\Models\ProductReturn;
use App\Models\ReturnItem;
use Illuminate\Support\Facades\DB;

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

        public function getInvoiceProducts(Request $request)
    {
        $invoiceId = $request->get('invoice_id');

        $products = InvoiceProduct::with('product:id,name') // Load related product name
            ->where('invoice_id', $invoiceId)
            ->select('product_id', 'quantity', 'price')
            ->get();

        return response()->json(['products' => $products]);
    }


    public function returnProduct(Request $request)
    {
   
     $validatedData = $request->validate([
        'invoice_id'      => 'required|integer',
        'productId'       => 'required|integer',
        'salable_status'  => 'required|string',
        'return_quantity' => 'required|integer|min:1',
        'return_reason'   => 'nullable|string',
    ]);

    DB::beginTransaction();
    try {
        // Step 1: Create ProductReturn entry (if not already created for this invoice)
        $productReturn = ProductReturn::firstOrCreate(
            [
                'invoice_id' => $validatedData['invoice_id'],
                'shop_id'    => 1,  // Replace with dynamic shop_id from the request or session
            ],
            [
                'return_date'    => now(),
                'salable_status' => $validatedData['salable_status'],
                'total_amount'   => 0,
            ]
        );
       
        // Step 2: Create ReturnItem entry
        $returnAmount = $this->calculateReturnAmount($validatedData['productId'], $validatedData['return_quantity']);
       
        $returnItem = ReturnItem::create([
            'product_return_id' => $productReturn->id,
            'product_id'        => $validatedData['productId'],
            'quantity'          => $validatedData['return_quantity'],
            'salable_status'    => $validatedData['salable_status'],
            'reason'            => $validatedData['return_reason'],
            'return_amount'     => $returnAmount,
        ]);

        // Step 3: Update total amount in ProductReturn
        $productReturn->total_amount += $returnAmount;
        $productReturn->save();

        DB::commit();

        return response()->json(['success' => true, 'message' => 'Product return handled successfully']);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
    return response()->json(['success' => true, 'message' => 'Product return processed successfully']);
    }

    private function calculateReturnAmount($productId, $quantity)
    {
        // Example calculation: Replace with actual logic to calculate the return amount
        $product = DB::table('products')->find($productId);
        $unitPrice = $product ? $product->price : 0;  // Replace 'price' with the actual column name
        return $unitPrice * $quantity;
    }
}