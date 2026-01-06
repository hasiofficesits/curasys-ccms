<?php

namespace App\Exports;

use App\Models\TblStockPharma;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockSummaryReportExport implements FromCollection, WithHeadings
{
    protected $itemId;
    protected $supplierId;

    public function __construct($itemId = null, $supplierId = null)
    {
        $this->itemId = $itemId;
        $this->supplierId = $supplierId;
    }

    public function collection()
    {
        $query = TblStockPharma::with(['category', 'suplier']);

        if (!empty($this->itemId)) {
            $query->where('ID', $this->itemId);
        }

        if (!empty($this->supplierId)) {
            $query->where('SupplierID', $this->supplierId);
        }

        $data = $query->get()->map(function ($item) {
            return [
                'ID' => $item->ID,
                'Item Name' => $item->Pharma_name,
                'Category' => $item->category->CategoryName ?? '',
                'Packet Qty' => $item->Pack_Qty,
                'Reorder Level' => $item->ReorderLevel,
                'Supplier' => $item->suplier->Company ?? '',
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return ['ID', 'Item Name', 'Category', 'Packet Qty', 'Reorder Level', 'Supplier'];
    }
}
