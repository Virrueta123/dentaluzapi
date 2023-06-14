<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class inventario extends Model
{
    use HasFactory;
    protected $primaryKey = 'Inx_Id';
    protected $guarded = [];
    protected $table = 'inventarios';

    public function consultorio( ){
        return $this->belongsTo(consultorio::class,"Cox_Id");
    }
    public function control(){
        return $this->hasone(control_inventario::class,"Inx_Id");
    }

    public function prueba($query){ 
        return $query->withCount(['control_inventario as total_sumar' => function ($query) {
            $query->select(DB::raw("*", DB::raw("SUM(CASE WHEN Cinx_Ingreso='DI' THEN Cinx_Cantidad ELSE 0 END) AS restar"), DB::raw("SUM(CASE WHEN Cinx_Ingreso='AU' THEN Cinx_Cantidad ELSE 0 END) AS sumar")));
        }]);
    }
}
