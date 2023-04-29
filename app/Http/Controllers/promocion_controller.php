<?php

namespace App\Http\Controllers;

use App\Exports\promocion_por_alumno_reporte;
use App\Exports\promocionReporte;
use App\Models\alumnos;
use App\Models\configuraciones;
use App\Models\historial_promocion; 
use App\Models\meses_promocion;
use App\Models\promocion_mensualidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class promocion_controller extends Controller
{
    /* script para crear mensualidades */
    public function script_add_meses(){

        $meses = meses_promocion::all();
        $alumnos = alumnos::all();

        foreach ($alumnos as $al) {
            foreach ($meses as $ms) {
                promocion_mensualidad::
                    create([
                        "Msp_Id" => $ms->Msp_Id,
                        "Al_Id" => $al->Al_Id,
                        "Prm_Monto" => 0
                    ]); 
            } 
        }
          
        return response()
            ->json();
        
    }
    /** monto actual de los alumnos  */
    public function monto_actual_por_alumno(Request $req){
        $Datax = $req->all();
        try {
            $ingresos = promocion_mensualidad::
                  where('Al_Id', $Datax["Al_Id"] ) 
                  ->sum('Prm_Monto');
            return response()
                ->json([
                    "message" => "suma cargado exitosamente ",
                    "error" => "error",
                    "success" => true,
                    "data" => $ingresos
                ]); 
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => "error",
                    "success" => false,
                    "data" => ""
                ]); 
        }
    }

    /**  agregando aportaciones  */
    public function add_aportaciones(Request $req){
        
        $Datax = $req->all();
        try {
            $url="";
            if(is_null($Datax["url"])){
                $url = "N";
            }else{
                $url = $Datax["url"];
            }

            $ingresoHistorial = historial_promocion::create([
                "Al_Id" => $Datax["Al_Id"],
                "Hxp_Monto"=> $Datax["monto_total"],
                "Hxp_Imagen" => $url,
                "Tt_Id" => $Datax["forma_pago"]
            ]);
            
            $cofiguraciones = configuraciones::where("Cof_Item","monto_aportacion_promocion")->first();
            
            $all = promocion_mensualidad::
                where( 'Al_Id', $Datax["Al_Id"] )->where('Prm_IsPago', 'N' )->get();

            $faltacompletar = promocion_mensualidad::
                where( 'Al_Id', $Datax["Al_Id"] )->where('Prm_IsPago', 'F' )->first();

            $faltacompletarupdate = promocion_mensualidad::
                where( 'Al_Id', $Datax["Al_Id"] )->where('Prm_IsPago', 'F' );
                
            $monto = $Datax["monto_total"];
             
            //si por primera vez se ingresa un aporte para un alumno
            if(count($all) == 9){
                 
                $cuantosveintes = $monto  / $cofiguraciones->Cof_Valor;
                $restante = $monto - intval($cuantosveintes)*$cofiguraciones->Cof_Valor;

                if (is_double($cuantosveintes) ){

                    for ($i=1; $i < intval($cuantosveintes) + 1; $i++) { 
                        $cambiar = promocion_mensualidad::where('Msp_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                        
                        $cambiar->update([ 
                            "Prm_Monto" => $cofiguraciones->Cof_Valor,
                            "Prm_IsPago"=>"Y",
                            "Hxp_Id"=> $ingresoHistorial->Hxp_Id
                        ]); 
                    }  
                    $cambiar = promocion_mensualidad::where('Msp_Id', intval($cuantosveintes) + 1)->where( 'Al_Id', $Datax["Al_Id"]);
                    $cambiar->update([ 
                        "Prm_Monto" =>$restante,
                        "Prm_IsPago"=>"F",
                        "Hxp_Id"=> $ingresoHistorial->Hxp_Id
                    ]);
                     
                }else{
                    for ($i=1; $i < intval($cuantosveintes) + 1; $i++) { 
                        $cambiar = promocion_mensualidad::where('Msp_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                        
                        $cambiar->update([ 
                            "Prm_Monto" => $cofiguraciones->Cof_Valor,
                            "Prm_IsPago"=>"Y",
                            "Hxp_Id"=> $ingresoHistorial->Hxp_Id
                        ]); 
                    }  
                }
            } 

           
       
            if( !is_null($faltacompletar) ){

                $montoabonar = $cofiguraciones->Cof_Valor - ($faltacompletar->Prm_Monto + $monto);

                if( $montoabonar >= 0 ){
                    if($montoabonar == 0){
                        $faltacompletarupdate->update([ 
                            "Prm_Monto" =>$cofiguraciones->Cof_Valor,
                            'Prm_IsPago'=> 'Y',
                            "Hxp_Id"=> $ingresoHistorial->Hxp_Id
                        ]);
                    }else{
                        $faltacompletarupdate->update([ 
                            "Prm_Monto" => $faltacompletar->Prm_Monto + $monto,
                            "Hxp_Id"=> $ingresoHistorial->Hxp_Id
                        ]);
                    }
                    
                  
                }else{
                    $montoa = $cofiguraciones->Cof_Valor - $faltacompletar->Prm_Monto;
                    $montob = $monto - $montoa;
                    $cuantosveintes = $montob  / $cofiguraciones->Cof_Valor; 
                    $restante = $montob - intval($cuantosveintes)*$cofiguraciones->Cof_Valor;

                    if( is_double($cuantosveintes) ){
                        
                        for ($i=$faltacompletar->Msp_Id; $i < $faltacompletar->Msp_Id + intval($cuantosveintes) + 1; $i++) { 
                            $cambiar = promocion_mensualidad::where('Msp_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                            
                            $cambiar->update([ 
                                "Prm_Monto" => $cofiguraciones->Cof_Valor,
                                "Prm_IsPago"=>"Y",
                                "Hxp_Id"=> $ingresoHistorial->Hxp_Id
                            ]); 
                        }  

                        $cambiar = promocion_mensualidad::where('Msp_Id', $faltacompletar->Msp_Id + intval($cuantosveintes) + 1)->where( 'Al_Id', $Datax["Al_Id"]);
                        $cambiar->update([ 
                            "Prm_Monto" =>$restante,
                            "Prm_IsPago"=>"F",
                            "Hxp_Id"=> $ingresoHistorial->Hxp_Id
                        ]);
                         
                    }else{

                        for ($i=$faltacompletar->Msp_Id; $i < $faltacompletar->Msp_Id + intval($cuantosveintes) + 1; $i++) { 
                            $cambiar = promocion_mensualidad::where('Msp_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                            
                            $cambiar->update([ 
                                "Prm_Monto" => $cofiguraciones->Cof_Valor,
                                "Prm_IsPago"=>"Y",
                                "Hxp_Id"=> $ingresoHistorial->Hxp_Id
                            ]); 
                        }   

                    }
                } 
          
            }else{
                
                $cuantosveintes = $monto  / $cofiguraciones->Cof_Valor;
                $restante = $monto - intval($cuantosveintes)*$cofiguraciones->Cof_Valor;
              
                if (is_double($cuantosveintes) ){

                    for ($i=(9-count($all)); $i < (9-count($all)) + intval($cuantosveintes) +1 + 1; $i++) { 
                        $cambiar = promocion_mensualidad::where('Msp_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                        
                        $cambiar->update([ 
                            "Prm_Monto" => $cofiguraciones->Cof_Valor,
                            "Prm_IsPago"=>"Y",
                            "Hxp_Id"=> $ingresoHistorial->Hxp_Id
                        ]); 
                    }  
                    $cambiar = promocion_mensualidad::where('Msp_Id', (9-count($all)) + intval($cuantosveintes) +1)->where( 'Al_Id', $Datax["Al_Id"]);
                    $cambiar->update([ 
                        "Prm_Monto" =>$restante,
                        "Prm_IsPago"=>"F",
                        "Hxp_Id"=> $ingresoHistorial->Hxp_Id
                    ]);
                     
                }else{
                    for ($i=(9-count($all)); $i < (9-count($all)) + intval($cuantosveintes) +1 ; $i++) { 
                        $cambiar = promocion_mensualidad::where('Msp_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                        
                        $cambiar->update([ 
                            "Prm_Monto" => $cofiguraciones->Cof_Valor,
                            "Prm_IsPago"=>"Y",
                            "Hxp_Id"=> $ingresoHistorial->Hxp_Id
                        ]); 
                    }  
                    
                }
            }
 
            return response()
                ->json([
                    "message" => "La aportaciones de la promocion se registro correctamente",
                    "error" => "error",
                    "success" => true,
                    "data" => ""
                ]); 
 

            /*$ingresos = promocion_mensualidad::
                create([
                    "Msp_Id" => 2,
                    "Al_Id" => $Datax["Al_Id"],
                    "Prm_Monto" => 20
                ]); 

            return response()
                ->json([
                    "message" => "ingresos cargado exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $ingresos
                ]); */
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => "error",
                    "success" => false,
                    "data" => ""
                ]); 
        }
    }

    /** datos que envia para el panel donde muestra el historial de la aportaciones de la promocion/  */
    public function historial(){ 
        
        try {
            $get = historial_promocion::with("alumnos")->with("tipotarjeta")->orderBy("created_at", 'desc')->get();
 
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
                    "error" => "error",
                    "success" => false,
                    "data" => ""
                ]);
        }

    }

    /** datos que envia para el panel donde muestra los gastos de la aportaciones de la promocion/  */
    public function egresos(){ 
        
        try {
            $get = historial_promocion::with("alumnos")->with("tipotarjeta")->where("Hxp_Operacion","E")->orderBy("created_at", 'desc')->get();
 
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
                    "error" => "error",
                    "success" => false,
                    "data" => ""
                ]); 
        }
    }

    /** add de los egresos de la promocion  */
    public function add_egreso(Request $res){ 
        
        try {

            $Datax = $res->all();

            $filtrar_monto = explode(",",$Datax["monto"]); 
            
        

            $ingresos_aportaciones_historial = historial_promocion::create([
                "Al_Id" =>26,
                "Hxp_Monto" =>   count($filtrar_monto)==1 ? $Datax["monto"]: $filtrar_monto[0].$filtrar_monto[1],
                "Hxp_Operacion" =>  "E",
                "Hxp_Descripcion" => $Datax["descripcion"], 
                "Hxp_Imagen" => $Datax["url"], 
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
                    "error" => ".$e.",
                    "success" => false,
                    "data" => ""
                ]); 
        }
    }

    //enviar todo los egresos totales de las aportaciones de la promocion
    public function egresos_totales( ){  
        try {
            $get = historial_promocion::where("Hxp_Operacion", 'E')->sum('Hxp_Monto');
 
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
                    "error" => "error",
                    "success" => false,
                    "data" => ""
                ]); 
        } 
    }  
    //------------------end 

    //enviar todo los ingresos totales de las aportaciones de la promocion
    public function ingresos_totales( ){ 
  
        try {

            $get = historial_promocion::where("Hxp_Operacion", 'I')->sum('Hxp_Monto');
 
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
                    "error" => "error",
                    "success" => false,
                    "data" => ""
                ]); 
        }
        
    }  
    //------------------end    

    //enviar caja total de las aportaciones de la promocion
    public function caja_total( ){ 
  
        try {
            
            $ingresos = historial_promocion::where("Hxp_Operacion", 'I')->sum('Hxp_Monto');
            $egresos = historial_promocion::where("Hxp_Operacion", 'E')->sum('Hxp_Monto');

            return response()
                ->json([
                    "message" => "caja total cargada exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $ingresos - $egresos
                ]); 

        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => "error",
                    "success" => false,
                    "data" => ""
                ]); 
        }
        
    }  
    //------------------end 
    
    // cargar el gasto con el id de este mismo
    public function show_egreso(Request $res){
        try {
            $Datax = $res->all();
            $get = historial_promocion::with("alumnos")->with("tipotarjeta")->where("Hxp_Id", $Datax["id_gasto"])->first();
 
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
                    "error" => "error",
                    "success" => false,
                    "data" => ""
                ]); 
        }
    }
    //------------------end  
    
    //exportar un reporte reporte 
    function export_aportaciones_excel(){ return Excel::download(new promocionReporte, 'aportaciones_'.Carbon::now()->format("y-m-d H:i:s").'.xlsx' ); }

    function promocion_reporte_por_alumno  ($id){ return Excel::download(new promocion_por_alumno_reporte($id), 'aportaciones_'.Carbon::now()->format("y-m-d H:i:s").'.xlsx' ); }
    
}
