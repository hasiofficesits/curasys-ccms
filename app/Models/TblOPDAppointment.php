<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblOPDAppointment extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblopd_appointment";
    protected $appends = ['body_total'];

    public function doctor()
    {
        return $this->hasOne(TblDoctor::class, 'DID', 'Dr_ID');
    }
    public function patient()
    {
        return $this->hasOne(TblPatient::class, 'ID', 'Pt_ID');
    }
    // getFirstNameAttribute
    public function getBodyTotalAttribute()
    {
        $head_id = $this->ID;
        $body = TblOPDAppointmentBody::where('App_ID', $head_id)->get();
        $total = 0;
        foreach ($body as $key => $value) {
            if ($value->Total) {
                $total = $total + $value->Total;
            } else {}
        }
        return $total;
    }

}
