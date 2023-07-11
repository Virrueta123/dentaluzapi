<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unidad_didactica_notas extends Model
{
    use HasFactory;
    protected $primaryKey = 'Udn_Id';  
    protected $table = 'unidad_didactica_notas';
    public $timestamps = false; 
    protected $hidden = ["Pnx_Id","Udn_Id"];
}
