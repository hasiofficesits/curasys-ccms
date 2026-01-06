<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblReturnNoteBody extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblsupplierreturnnotebody";

    public function item()
    {
        return $this->hasOne(TblStockPharma::class, 'ID', 'ItemID');
    }
}
