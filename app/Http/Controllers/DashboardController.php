<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Payment;
use App\Models\Invoice; // Replace with your actual model
use Carbon\Carbon;
use Illuminate\Support\Str;

class DashboardController extends Controller
{

    public function showInvoiceChart()
    {
        // Get the current date
        $currentDate = Carbon::now();
    
        // Array to store months (e.g., 2025-01, 2024-12)
        $months = [];
        // Array to store the corresponding totals
        $totalAmount = [];
    
        // Loop through the last 12 months, including the current month
        for ($i = 0; $i < 12; $i++) {
            // Get the month in 'Y-m' format (e.g., '2025-01', '2024-12', etc.)
            $month = $currentDate->copy()->subMonths($i)->format('Y-m');
            $months[] = $month;
    
            // Query for total invoice amount for the current month
            $total = DB::table('invoices')
                ->whereMonth('created_at', '=', $currentDate->copy()->subMonths($i)->month)
                ->whereYear('created_at', '=', $currentDate->copy()->subMonths($i)->year)
                ->where('delete_flag', 0)
                ->sum('total_amount'); // Sum of total for this month
    
            // If no data, set total to 0
            $totalAmount[] = $total ?: 0;
        }
    
        // Pass the months and totals to the view
        return view('dashboard.index', compact('months', 'totalAmount'));
    }


}
