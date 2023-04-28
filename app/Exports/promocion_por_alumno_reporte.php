<?php

namespace App\Exports;

use App\Models\alumnos;
use App\Models\configuraciones;
use App\Models\promocion_mensualidad;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class promocion_por_alumno_reporte implements FromView,ShouldAutoSize 
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
       $aportaciones = promocion_mensualidad::where("Al_Id",$this->Al_Id)->get();  
       
       $sum = promocion_mensualidad::where("Al_Id",$this->Al_Id)->sum("Prm_Monto"); 
        
       $cofiguraciones = configuraciones::where("Cof_Item","monto_total_aportaciones")->first();
       
       return view('export.excel.promocion_por_alumno_report', [ 
           "alumnos" => $alumnos, 
           "sum" => $sum,
           "aportaciones" => $aportaciones,
           "total_aporte" => $cofiguraciones->Cof_Valor
         ]);
   }
}
