<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblGrnBody extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblgrnbody";

    public function item()
    {
        return $this->hasOne(TblStockPharma::class, 'ID', 'ItemID');
    }

    public function header()
    {
        // This links the body to the head using Grnno -> Grid
        return $this->belongsTo(TblGrnHead::class, 'Grnno', 'Grid');
    }
}
