<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblStockLocation extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblstock_location";
}
