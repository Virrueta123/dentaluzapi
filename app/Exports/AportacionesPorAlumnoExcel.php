<?php

namespace App\Exports;

use App\Models\alumnos;
use App\Models\configuraciones;
use App\Models\ingresos_aportaciones_historial;
use App\Models\ingresosAportaciones;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

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
    public function view(): View
    {
        $alumnos = alumnos::where("Al_Id",$this->Al_Id)->first();   
        $aportaciones = ingresosAportaciones::where("Al_Id",$this->Al_Id)->get();  
        
        $sum = ingresosAportaciones::where("Al_Id",$this->Al_Id)->sum("Ipo_Monto"); 
         
        $cofiguraciones = configuraciones::where("Cof_Item","monto_total_aportaciones")->first();
        
        return view('export.excel.aportaciones_apafa_reporte_por_alumno', [ 
            "alumnos" => $alumnos, 
            "sum" => $sum,
            "aportaciones" => $aportaciones,
            "total_aporte" => $cofiguraciones->Cof_Valor
          ]);
    }
}
