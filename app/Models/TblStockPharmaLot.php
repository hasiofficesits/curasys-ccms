<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblStockPharmaLot extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblstock_pharma_lot";

    public function supplier()
    {
        return $this->hasOne(TblSupplier::class, 'ID', 'Supplier_ID');
    }
    public function stock_item()
    {
        return $this->hasOne(TblStockPharma::class, 'ID', 'FKStock_ID');
    }
}
