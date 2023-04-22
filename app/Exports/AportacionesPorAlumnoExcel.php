<?php

namespace App\Exports;

use App\Models\alumnos;
use App\Models\configuraciones;
use App\Models\ingresos_aportaciones_historial;
use Maatwebsite\Excel\Concerns\FromCollection;

class AportacionesPorAlumnoExcel implements FromView,ShouldAutoSize 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $Al_Id;
    public function __construct($Al_Id)
    { 
        $this->Al_Id = $Al_Id;  
    }
    public function collection()
    {
        $alumnos = alumnos::where("Al_Id",$this->Al_Id)->get();   
        $egresos = ingresos_aportaciones_historial::where("Iah_Operacion","E")->get();  
     
        $egresosTotal = ingresos_aportaciones_historial::where("Iah_Operacion", 'E')->sum('Iah_Monto');
        $ingresosTotal = ingresos_aportaciones_historial::where("Iah_Operacion", 'I')->sum('Iah_Monto');
 
        $cofiguraciones = configuraciones::where("Cof_Item","monto_total_aportaciones")->first();

        return view('export.excel.aportaciones_apafa_reporte_por_alumno', [ 
            "alumnos" => $alumnos,
            "egresos" => $egresos,
            "egresosTotal" => $egresosTotal,
            "ingresosTotal" => $ingresosTotal,
            "total_aporte" => $cofiguraciones->Cof_Valor
          ]);
    }
}
