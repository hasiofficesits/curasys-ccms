<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblPtIX extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblpt_ix";

    public function body()
    {
        return $this->hasMany(TblPtIXBody::class, 'Ix_id', 'Id');
    }
}
