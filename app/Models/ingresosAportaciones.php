<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingresosAportaciones extends Model
{
    use HasFactory;
    protected $table = "ingresos_aportaciones";
    protected $primaryKey = 'Ipo_Id';
    public $timestamps = true;
    protected $guarded = [ ];
}
