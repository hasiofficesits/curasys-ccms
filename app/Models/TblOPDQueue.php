<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblOPDQueue extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblopdqueue";

    public function patient()
    {
        return $this->hasOne(TblPatient::class, 'ID', 'Pt_id');
    }
}
