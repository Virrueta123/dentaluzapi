<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona_nota extends Model
{
    use HasFactory;
    protected $primaryKey = 'Pnx_Id';  
    protected $table = 'persona_nota';
    public $timestamps = false; 
    protected $hidden = ["Pnx_Id","ANATOMIAHUMANA",
    "ANATOMIAHUMANANOTA",
    "BIOLOGIAGENERAL",
    "BIOLOGIAGENERALNOTA",
    "PSICOLOGIAGENERALYEVOLUTIVA",
    "PSICOLOGIAGENERALYEVOLUTIVANOTA",
    "BIOFISICA",
    "BIOFISICANOTA",
    "QUIMICAGENERAL",
    "QUIMICAGENERALNOTA",
    "FUNDAMENTOSDEENFERMERIAI",
    "FUNDAMENTOSDEENFERMERIAINOTA",
    "COMUNICACION",
    "COMUNICACIONNOTA"];

    public function unidad_didactica(){
        return $this->hasMany(unidad_didactica_notas::class,"Pnx_Id");
    }
}
