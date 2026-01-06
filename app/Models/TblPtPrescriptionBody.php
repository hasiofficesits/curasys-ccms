<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblPtPrescriptionBody extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblpt_prescription_body";

    public function item()
    {
        return $this->hasOne(TblStockPharma::class, 'ID', 'Pharma_Id');
    }
}
