<?php

namespace App\Exports;

use App\Models\TblStockPharmaLot;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class ExpiredStockLotExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = TblStockPharmaLot::with(['stock_item', 'supplier'])
            ->whereNotNull('Exp_date')
            ->whereDate('Exp_date', '<', now());

        if (!empty($this->filters['pharma_item'])) {
            $query->where('FKStock_ID', $this->filters['pharma_item']);
        }

        if (!empty($this->filters['pharma_supplier'])) {
            $query->where('Supplier_ID', $this->filters['pharma_supplier']);
        }

        if (!empty($this->filters['from_date']) && !empty($this->filters['to_date'])) {
            $query->whereBetween('Exp_date', [$this->filters['from_date'], $this->filters['to_date']]);
        }

        return $query->orderBy('Exp_date', 'ASC')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Item Name',
            'Expired Date',
            'Quantity',
            'Supplier',
        ];
    }

    public function map($row): array
    {
        return [
            $row->ID,
            $row->stock_item->Pharma_name ?? '-',
            $row->Exp_date ? Carbon::parse($row->Exp_date)->format('Y-m-d') : '-',
            $row->QTY ?? 0,
            $row->supplier->Company ?? '-',
        ];
    }
}
