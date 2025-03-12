<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportUsers;
use App\Exports\ExportGrn;
use App\Imports\ImportUsers;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function importExport()
    {
       return view('import');
    }

    public function export() 
    {
       
        return Excel::download(new ExportUsers, 'users.xlsx');

    }

    public function import() 
    {
        Excel::import(new ImportUsers, request()->file('file'));
            
        return back();
    }
    

    public function export_admin() 
    {
       
        return Excel::download(new ExportGrn, 'grn.xlsx');
    }
    
}
