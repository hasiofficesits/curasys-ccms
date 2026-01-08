<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblStockPharma extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblstock_pharma";

    public function category()
    {
        return $this->hasOne(TblStockPharmaCategory::class, 'ID', 'FKCatrgory');
    }
    public function suplier()
    {
        return $this->hasOne(TblSupplier::class, 'ID', 'FKSupplier_ID');
    }
    public function lots()
    {
        return $this->hasMany(TblStockPharmaLot::class, 'FKStock_ID', 'ID');
    }
}
