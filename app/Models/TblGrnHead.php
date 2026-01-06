<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblGrnHead extends Model
{
    use HasFactory;

    protected $primaryKey = 'Grid';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblgrnhead";

    public function supplier()
    {
        return $this->hasOne(TblSupplier::class, 'ID', 'Supplier');
    }
}
