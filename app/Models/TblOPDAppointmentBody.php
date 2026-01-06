<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblOPDAppointmentBody extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblopd_appointment_body";

    public function item()
    {
        return $this->hasOne(TblStockPharma::class, 'ID', 'StockServiceID');
    }
    public function service()
    {
        return $this->hasOne(TblOPDService::class, 'ID', 'StockServiceID');
    }
}
