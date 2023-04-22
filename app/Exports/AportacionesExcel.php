<?php

namespace App\Exports;

use App\Models\alumnos;
use App\Models\configuraciones;
use App\Models\ingresos_aportaciones_historial;
use App\Models\ingresosAportaciones;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AportacionesExcel implements FromView,ShouldAutoSize 
{
    /**
    * @return \Illuminate\Support\Collection
    */
   public function __construct( )
   {  
   }

   public function view(): View
   {    

       $alumnos = alumnos::where("Al_Comodin","N")->get();   
       $egresos = ingresos_aportaciones_historial::where("Iah_Operacion","E")->get();  
    
       $egresosTotal = ingresos_aportaciones_historial::where("Iah_Operacion", 'E')->sum('Iah_Monto');
       $ingresosTotal = ingresos_aportaciones_historial::where("Iah_Operacion", 'I')->sum('Iah_Monto');

       $cofiguraciones = configuraciones::where("Cof_Item","monto_total_aportaciones")->first();

       return view('export.excel.aportaciones_reporte', [ 
         "alumnos" => $alumnos,
         "egresos" => $egresos,
         "egresosTotal" => $egresosTotal,
         "ingresosTotal" => $ingresosTotal,
         "total_aporte" => $cofiguraciones->Cof_Valor
       ]);
       
   } 
}
