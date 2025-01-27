<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Payment;
use App\Models\Invoice; 
use Illuminate\Http\Request;

class RefController extends Controller
{
    public function index()
    {

        $invoices = Invoice::with('shop')
        ->where('delete_flag', 0)  // Add the filter for delete_flag
        ->paginate(10);
    
     
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


}