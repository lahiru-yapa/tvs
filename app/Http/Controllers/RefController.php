<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Payment;
use App\Models\Invoice; 
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class RefController extends Controller
{
    public function index()
    {

        $invoices = Invoice::with('shop')
        ->where('delete_flag', 0) // Add the filter for delete_flag
        ->paginate(10);
    
     
        return view('invoices.ref.viewInvoice', compact('invoices')); 
    }


    public function filterIndex()
    {
        $query = Invoice::with('shop')->where('delete_flag', 0);
    
        // Apply filter based on the query parameter
        if ($filter = request()->get('filter')) {
            $query->where('description', ucfirst($filter)); // Capitalize the filter value (e.g., "approved")
        }
    
        $invoices = $query->paginate(10);
    
        return view('invoices.ref.viewInvoice', compact('invoices'));
    }
    
    
    public function handleAction(Request $request)
{
  
    $action = $request->input('action');
    $invoiceId = $request->input('invoice_id');

    switch ($action) {
        case 'view':
            // Eager load the invoice products and shop details along with the invoice
         $invoice = Invoice::with(['invoiceProducts.product', 'shop'])->findOrFail($invoiceId);
         return view('invoices.ref.show', compact('invoice')); // Return the view for the invoice details

        case 'edit':
            $invoices = Invoice::with('shop', 'invoiceProducts','invoiceProducts.product')
            ->where('id',$invoiceId)
            ->first(); // Fetch a single invoice
        
                $shops = Shop::all();
                 $products = Product::all();  
            return view('invoices.ref.edit', compact('invoices','shops','products')); 

        case 'delete':
            // Handle the delete action (e.g., confirm deletion or perform the delete)
            $invoice = Invoice::findOrFail($invoiceId);
           
            $invoice->delete_flag = 1;
            $invoice->save();
            return redirect()->route('refinvoice.index')->with('success', 'Invoice deleted successfully.');

        default:
            return redirect()->back()->with('error', 'Invalid action selected.');
    }
}



public function updateInvoice(Request $request, $id)
{
 
    DB::beginTransaction(); // Start a database transaction

    try {
       
        // Validate the request
        $validatedData = $request->validate([
            'shop_id' => 'required|exists:shops,id',
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
                return redirect()->back()->with('returnerror', 'Sorry Current balance: ' . $shop->current_balance);
            }
        }

        // Generate invoice number
        $invoiceNumber = 'INV-' . date('Ymd') . '-' . Str::random(6);

        // Set the invoice_date to today's date if not provided
        $invoiceDate = $request->invoice_date ?? Carbon::today();
       
        // Calculate the due date as 30 days from the invoice date
        $dueDate = Carbon::parse($invoiceDate)->addDays(30);

        $invoice = Invoice::findOrFail($id);
        $invoice->update([
            'shop_id' => $validatedData['shop_id'],
            'user_id' => auth()->user()->id,
            'invoice_number' => $invoiceNumber,
            'total_amount' => $request->totalAmount,
            'paid_amount' => $request->paidAmount ?? $invoice->paid_amount, // Use existing value if not provided
            'paid_status' => $request->payment >= $request->totalAmount ? true : false,
            'due_date' => $dueDate,
            'invoice_date' => $invoiceDate,
        ]);
        
      
        // Add counts to selected products
        $counts = $request->input('counts', []);
        $selectedProducts = array_map(function ($product) use ($counts) {
            $productId = $product['id'];
            $product['count'] = $counts[$productId] ?? 0;
            return $product;
        }, $selectedProducts);
       
       // Save products to the invoice
foreach ($selectedProducts as $productData) {
    $total = $productData['count'] * $productData['amount'];

    // Check if the product already exists in the invoice
    $invoiceProduct = $invoice->invoiceProducts()
        ->where('product_id', $productData['id'])
        ->first();
       
    if ($invoiceProduct) {
        // Update the existing invoice product
        $invoiceProduct->update([
            'quantity' => $productData['count'],
            'price' => $productData['amount'],
            'total' => $total,
        ]);
    } else {
       
        // Create a new invoice product if it doesn't exist
        $invoice->invoiceProducts()->create([
            'invoice_id' => $id,
            'product_id' => $productData['id'],
            'quantity' => $productData['count'],
            'price' => $productData['amount'],
            'total' => $total,
        ]);
    }
}

        DB::commit(); // Commit the transaction if all operations are successful

        return redirect()->route('refinvoice.index')->with('success', 'Invoice created successfully.');
    } catch (\Exception $e) {
        dd(e);
        DB::rollBack(); // Rollback the transaction if any operation fails
        return redirect()->back()->with('error', 'An error occurred while creating the invoice. Please try again.');
    }
}


}