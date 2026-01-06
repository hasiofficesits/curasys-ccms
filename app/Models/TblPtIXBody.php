<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblPtIXBody extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblpt_ix_body";

    public function head()
    {
        return $this->hasOne(TblPtIX::class, 'Id', 'Ix_id');
    }
}
