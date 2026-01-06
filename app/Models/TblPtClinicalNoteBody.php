<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblPtClinicalNoteBody extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id';

    protected $guarded = [];
    public $timestamps = false;
    protected $table = "tblpt_clinical_note_body";

    public function head()
    {
        return $this->hasOne(TblPtClinicalNote::class, 'Id', 'Note_Id');
    }
}
