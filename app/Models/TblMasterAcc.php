<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TblMasterAcc extends Model
{
    protected $table="tblmasteracc";
    // public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $guarded=[];

    public function getCRTotal()
    {
        $code=$this->Code;
        $total=TblGl::whereRaw("AccCode Like '$code%'")->sum("Cr");

        return $total;
    }

    public function getDRTotal()
    {
        $code=$this->Code;
        $total=TblGl::whereRaw("AccCode Like '$code%'")->sum("Dr");

        return $total;
    }

    public function ledgers()
    {

    }
}
