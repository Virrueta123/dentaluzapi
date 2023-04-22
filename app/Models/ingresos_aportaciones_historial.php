<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ingresos_aportaciones_historial extends Model
{
    use HasFactory;
    protected $table = "ingresos_aportaciones_historial";
    protected $primaryKey = 'Iah_Id';
    public $timestamps = true;
    protected $guarded = [ ];

    public function alumnos(){
        return $this->belongsTo(alumnos::class,"Al_Id");
    }
}
