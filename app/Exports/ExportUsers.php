<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUsers implements FromCollection
{
    public function collection()
    {
        return Invoice::with('shop')
            ->where('delete_flag', 0)
            ->orderBy('created_at', 'desc')
            ->get(); // ✅ Fetch data
    }
    
    

}
