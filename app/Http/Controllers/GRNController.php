<?php

namespace App\Http\Controllers;

use App\Models\GRN;
use App\Models\GRNItem;
use App\Models\Warehouse;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class GRNController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $grns = GRN::with(['items', 'warehouse', 'supplier'])
        ->where('delete_flag', 0)
        ->get();

        $supllier = Supplier::where('delete_flag', 0)->get();

        return view('grn.index', compact('grns','supllier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warehouses = Warehouse::all();
        $supllier = Supplier::where('delete_flag', 0)->get();
        $products = Product::where('delete_flag', 0)->get();
        return view('grn.create', compact('warehouses','supllier','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
       $request->validate([
        'warehouse_id' => 'required',
        'grn_number' => 'required',
        'received_date' => 'required|date',
        'supllier_id' => 'required',
        'items.*.product_id' => 'required',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.unit_price' => 'required|numeric|min:0',
          ]);
    
      
        $grn = GRN::create([
            'grn_number' => $request->grn_number,
            'warehouse_id' => $request->warehouse_id,
            'received_date' => $request->received_date,
            'supplier_id' => $request->supllier_id,
            'remarks' => $request->remarks,
        ]);
        
        foreach ($request->items as $item) {
            GRNItem::create([
                'grn_id' => $grn->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['quantity'] * $item['unit_price'],
                'warranty_period' => $item['warranty_period'],
            ]);
        }

        return redirect()->route('grns.index')->with('success', 'GRN created successfully.');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $grns = GRN::with(['items', 'warehouse','supplier'])
        ->whereHas('items', function ($query) use ($id) {
            $query->where('grn_id', $id);
        })
        ->first();
        $suplliers = Supplier::where('delete_flag', 0)->get();
        $products  = Product::where('delete_flag', 0)->get();
        $warehouses = Warehouse::all();
        return view('grn.show', compact('grns','products','suplliers','warehouses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $grns = GRN::with(['items', 'warehouse','supplier'])
        ->whereHas('items', function ($query) use ($id) {
            $query->where('grn_id', $id);
        })
        ->first();
    
        $warehouses = Warehouse::all();
        $suplliers = Supplier::where('delete_flag', 0)->get();
        $products  = Product::where('delete_flag', 0)->get();
     
        return view('grn.edit', compact('warehouses','suplliers','grns','products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
       // Validate the input data
    $request->validate([
        'warehouse_id' => 'required',
        'grn_number' => 'required',
        'received_date' => 'required|date',
        'supplier_id' => 'required',
        'items.*.product_id' => 'required',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.unit_price' => 'required|numeric|min:0',
    ]);
 
     // Find the GRN to update
     $grn = GRN::findOrFail($id);

     // Update the GRN attributes
     $grn->update([
         'grn_number' => $request->grn_number,
         'warehouse_id' => $request->warehouse_id,
         'received_date' => $request->received_date,
         'supplier_id' => $request->supplier_id,
         'remarks' => $request->remarks,
     ]);
     // Remove existing GRN items associated with this GRN
     $grn->items()->delete(); // Assuming a one-to-many relationship
 
     foreach ($request->items as $index => $itemData) {
        if (isset($itemData['id'])) {
            // Update existing item
            $grnItem = GRNItem::findOrFail($itemData['id']);
            $grnItem->update([
                'product_id' => $itemData['product_id'],
                'quantity' => $itemData['quantity'],
                'unit_price' => $itemData['unit_price'],
                'warranty_period' => $itemData['warranty_period'],
            ]);
        } else {
            // Add new item
         
            $grn->items()->create([
                'grn_id' => $request->grn_number,
                'product_id' => $itemData['product_id'],
                'quantity' => $itemData['quantity'],
                'unit_price' => $itemData['unit_price'],
                'total_price' => $itemData['quantity'] * $itemData['unit_price'],
                'warranty_period' => $itemData['warranty_period'],
            ]);
        }
    }
   
     // Redirect back with a success message
     return redirect()->route('grns.index')->with('success', 'GRN updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

     
         // Find the user by ID
         $grn = GRN::findOrFail($id);
    
         // Set delete_flag to 1
         $grn->delete_flag = 1;
         $grn->save();
         return redirect()->route('grns.index')->with('success', 'GRN deleted successfully.');
    }
}