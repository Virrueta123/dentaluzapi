<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_egreso extends Model
{
    protected $table = "tipoegresos";
    protected $primaryKey = 'Teg_Id';
    public $timestamps = false;
    protected $guarded = [ ];
    use HasFactory;
}
