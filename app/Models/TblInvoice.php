<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblInvoice extends Model
{
    use HasFactory;

    protected $primaryKey = 'invno';

    protected $guarded = [];
    public $timestamps = true;
    protected $table="tblinvoice";

    public function inv_body()
    {
        return $this->hasMany(TblInvoiceBody::class, 'invno', 'invno');
    }
    public function customer()
    {
        return $this->hasOne(TblPatient::class, 'ID', 'cusid');
    }

}
