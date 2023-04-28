<?php

namespace App\Exports;

use App\Models\alumnos;
use App\Models\configuraciones;
use App\Models\historial_promocion;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class promocionReporte implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
   public function __construct()
   { 
   
   }
    public function view(): View
    {
        $alumnos = alumnos::where("Al_Comodin","N")->get();   
        $egresos = historial_promocion::where("Hxp_Operacion","E")->get();  
     
        $egresosTotal = historial_promocion::where("Hxp_Operacion", 'E')->sum('Hxp_Monto');
        $ingresosTotal = historial_promocion::where("Hxp_Operacion", 'I')->sum('Hxp_Monto');
 
        $cofiguraciones = configuraciones::where("Cof_Item","monto_total_aportaciones")->first();

        return view('export.excel.promocion', [ 
            "alumnos" => $alumnos,
            "egresos" => $egresos,
            "egresosTotal" => $egresosTotal,
            "ingresosTotal" => $ingresosTotal,
            "total_aporte" => $cofiguraciones->Cof_Valor
          ]);
    }
}
