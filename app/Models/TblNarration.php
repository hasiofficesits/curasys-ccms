<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblNarration extends Model
{
    protected $table="tblnarration";
    // public $timestamps=false;
    protected $primaryKey = 'ID';
    protected $guarded=[];

    public function getCRTotal()
    {
        $code=$this->AccCode;
        $total=TblGl::whereRaw("AccCode Like '$code'")->sum("Cr");

        return $total;
    }

    public function getDRTotal()
    {
        $code=$this->AccCode;
        $total=TblGl::whereRaw("AccCode Like '$code'")->sum("Dr");

        return $total;
    }

    public function groupdata()
    {
        return $this->hasOne(TblAccGroup::class,'ID','Group');
    }

    public function masterdata()
    {
        return $this->hasOne(TblMasterAcc::class,'ID','MasterAcc');
    }
}
