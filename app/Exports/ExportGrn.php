<?php
namespace App\Exports;
 
use App\Models\GRN;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExportGrn implements FromArray, WithHeadings, WithStyles, WithColumnWidths
{
    public function array(): array
    {
        $grns = GRN::with(['items.product', 'warehouse', 'supplier']) // Eager load product relation
            ->where('delete_flag', 0)
            ->get();

        $data = [];

        foreach ($grns as $grn) {
            // GRN main data row
            $data[] = [
                $grn->grn_number,
                $grn->warehouse->name ?? 'N/A',
                $grn->received_date,
                $grn->supplier->name ?? 'N/A',
                $grn->remarks ?? 'N/A',
                '', '', '', '', '', // Placeholders for items
            ];

            // Loop through related items
            foreach ($grn->items as $item) {
                $data[] = [
                    '', '', '', '', '', // Empty cells for GRN info
                    $item->product->name ?? 'N/A', // Product name
                    $item->quantity ?? 0,
                    $item->unit_price ?? 0,
                    $item->total_price ?? 0,
                    $item->warranty_period ?? 'N/A',
                ];
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return [
            'GRN Number',
            'Warehouse',
            'Received Date',
            'Supplier',
            'Remarks',
            'Product Name',
            'Quantity',
            'Unit Price',
            'Total Price',
            'Warranty Period',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Bold the first row (headers)
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 20, // GRN Number
            'B' => 30, // Warehouse
            'C' => 20, // Received Date
            'D' => 30, // Supplier
            'E' => 40, // Remarks
            'F' => 30, // Product Name
            'G' => 10, // Quantity
            'H' => 15, // Unit Price
            'I' => 15, // Total Price
            'J' => 20, // Warranty Period
        ];
    }
}