<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblSahanyaCompany extends Model
{
    use HasFactory;

    protected $primaryKey = 'com_id';

    protected $guarded = [];
    public $timestamps = false;
    protected $table="sahanya_company";
}
