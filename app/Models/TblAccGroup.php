<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblAccGroup extends Model
{
    use HasFactory;
    protected $table="tblaccgroup";
    public $timestamps=true;
    protected $primaryKey = 'ID';
    protected $guarded=[];
}
