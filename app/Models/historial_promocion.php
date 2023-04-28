<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class historial_promocion extends Model
{
    use HasFactory;
    protected $table = "historial_promocion";
    protected $primaryKey = 'Hxp_Id';
    public $timestamps = true;
    protected $guarded = [ ];

    public function alumnos(){
        return $this->belongsTo(alumnos::class,"Al_Id");
    }

    public function tipotarjeta(){
        return $this->belongsTo(tipocuentas::class,"Tt_Id");
    }
}
