<?php

namespace App\Http\Controllers;

use App\Exports\AportacionesExcel;
use App\Models\ingresos_aportaciones_historial;
use App\Models\ingresosAportaciones;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;
use Maatwebsite\Excel\Facades\Excel;
class ingresos_aportaciones_historial_controller extends Controller
{
    public function historial(){ 
        
        try {
            $get = ingresos_aportaciones_historial::with("alumnos")->orderBy("created_at", 'desc')->get();
 
            return response()
                ->json([
                    "message" => "historial cargado exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $get 
                ]); 
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => $e,
                    "success" => false,
                    "data" => ""
                ]); 
        }
    }

    public function show_egreso(Request $res){
        try {
            $Datax = $res->all();
            $get = ingresos_aportaciones_historial::with("alumnos")->where("Iah_Id", $Datax["id_gasto"])->first();
 
            return response()
                ->json([
                    "message" => "gasto cargado exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $get 
                ]); 
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => $e,
                    "success" => false,
                    "data" => ""
                ]); 
        }
    }

    public function egresos(){ 
        
        try {
            $get = ingresos_aportaciones_historial::with("alumnos")->where("Iah_Operacion","E")->orderBy("created_at", 'desc')->get();
 
            return response()
                ->json([
                    "message" => "egresos cargado exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $get 
                ]); 
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => true,
                    "success" => false,
                    "data" => ""
                ]); 
        }
    }

    //enviar todo los egresos totales de las aportaciones de 20 soles 
    public function egresos_totales( ){ 
  
        try {
            $get = ingresos_aportaciones_historial::where("Iah_Operacion", 'E')->sum('Iah_Monto');
 
            return response()
                ->json([
                    "message" => "total de egresos cargados exitosamente exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $get
                ]); 
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => true,
                    "success" => false,
                    "data" => ""
                ]); 
        }
        
    }  
    //------------------end 


    //enviar todo los egresos totales de las aportaciones de 20 soles 
    public function ingresos_totales( ){ 
  
        try {

            $get = ingresos_aportaciones_historial::where("Iah_Operacion", 'I')->sum('Iah_Monto');
 
            return response()
                ->json([
                    "message" => "ingresos cargados exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $get
                ]); 

        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => true,
                    "success" => false,
                    "data" => ""
                ]); 
        }
        
    }  
    //------------------end     


    //enviar todo los egresos totales de las aportaciones de 20 soles 
    public function caja_total( ){ 
  
        try {
            
            $ingresos = ingresos_aportaciones_historial::where("Iah_Operacion", 'I')->sum('Iah_Monto');
            $egresos = ingresos_aportaciones_historial::where("Iah_Operacion", 'E')->sum('Iah_Monto');

            return response()
                ->json([
                    "message" => "ingresos cargados exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $ingresos - $egresos
                ]); 

        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => true,
                    "success" => false,
                    "data" => ""
                ]); 
        }
        
    }  
    //------------------end        

    public function add_egreso(Request $res){ 
        
        try {

            $Datax = $res->all();
            $ingresos_aportaciones_historial = ingresos_aportaciones_historial::create([
                "Al_Id" =>26,
                "Iah_Monto" => $Datax["monto"],
                "Iah_Operacion" =>  "E",
                "Iah_Descripcion" => $Datax["descripcion"], 
                "Iah_Imagen" => $Datax["url"], 
            ]); 

            if ($ingresos_aportaciones_historial) {
                return response()
                ->json([
                    "message" => "gasto creado exitosamente",
                    "error" => "",
                    "success" => true,
                    "data" => ""
                ]);
            }else{
                return response()
                ->json([
                    "message" => "gasto no se ingreso correctamente, intentelo de nuevo",
                    "error" => "",
                    "success" => false,
                    "data" => ""
                ]);
            }
             
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "gasto no se ingreso correctamente, intentelo de nuevo",
                    "error" => "error =>".$e,
                    "success" => false,
                    "data" => ""
                ]); 
        }
    }
    

    //exportar reporte

    function export_aportaciones_excel(){
        return Excel::download(new AportacionesExcel, 'aportaciones_'.Carbon::now()->format("y-m-d H:i:s").'.xlsx' );
    }
}
