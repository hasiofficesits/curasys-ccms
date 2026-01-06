<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblReturnNoteHead extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblsupplierreturnnotehead";

    public function supplier()
    {
        return $this->hasOne(TblSupplier::class, 'ID', 'FkSupplierID');
    }
}
