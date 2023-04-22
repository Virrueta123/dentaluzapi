<?php

namespace App\Http\Controllers;

use App\Models\alumnos;
use App\Models\ingresos_aportaciones_historial;
use App\Models\ingresosAportaciones;
use App\Models\meses_aportaciones;
use Illuminate\Http\Request;
use Throwable;

class ingresosAportacionesController extends Controller
{ 
    public function script_add_meses(){

        $meses = meses_aportaciones::all();
        $alumnos = alumnos::all();

        foreach ($alumnos as $al) {
            foreach ($meses as $ms) {
                ingresosAportaciones::
                    create([
                        "Msa_Id" => $ms->Msa_Id,
                        "Al_Id" => $al->Al_Id,
                        "Ipo_Monto" => 0
                    ]); 
            } 
        }
          
        return response()
            ->json();
        
    }

    public function monto_actual_por_alumno(Request $req){
        $Datax = $req->all();
        try {
            $ingresos = ingresosAportaciones::
                  where('Al_Id', $Datax["Al_Id"] ) 
                ->sum('Ipo_Monto');
            return response()
                ->json([
                    "message" => "ingresos cargado exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $ingresos
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

    public function add_aportaciones(Request $req){
        $Datax = $req->all();
        try {

            $ingresoHistorial = ingresos_aportaciones_historial::create([
                "Al_Id" => $Datax["Al_Id"],
                "Iah_Monto"=> $Datax["monto_total"] 
            ]);
 
            
            $all = ingresosAportaciones::
                where( 'Al_Id', $Datax["Al_Id"] )->where('Msa_SinIngreso', 'N' )->get();

            $faltacompletar = ingresosAportaciones::
                where( 'Al_Id', $Datax["Al_Id"] )->where('Msa_SinIngreso', 'F' )->first();

            $faltacompletarupdate = ingresosAportaciones::
                where( 'Al_Id', $Datax["Al_Id"] )->where('Msa_SinIngreso', 'F' );
                
            $monto = $Datax["monto_total"];
             
            //si por primera vez se ingresa un aporte para un alumno
            if(count($all) == 10){
               
                $cuantosveintes = $monto  / 20;
                $restante = $monto - intval($cuantosveintes)*20;

                if (is_double($cuantosveintes) ){

                    for ($i=1; $i < intval($cuantosveintes) + 1; $i++) { 
                        $cambiar = ingresosAportaciones::where('Msa_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                        
                        $cambiar->update([ 
                            "Ipo_Monto" => 20.00,
                            "Msa_SinIngreso"=>"Y",
                            "Iah_Id"=> $ingresoHistorial->Iah_Id
                        ]); 
                    }  
                    $cambiar = ingresosAportaciones::where('Msa_Id', intval($cuantosveintes) + 1)->where( 'Al_Id', $Datax["Al_Id"]);
                    $cambiar->update([ 
                        "Ipo_Monto" =>$restante,
                        "Msa_SinIngreso"=>"F",
                        "Iah_Id"=> $ingresoHistorial->Iah_Id
                    ]);
                     
                }else{
                    for ($i=1; $i < intval($cuantosveintes) + 1; $i++) { 
                        $cambiar = ingresosAportaciones::where('Msa_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                        
                        $cambiar->update([ 
                            "Ipo_Monto" => 20.00,
                            "Msa_SinIngreso"=>"Y",
                            "Iah_Id"=> $ingresoHistorial->Iah_Id
                        ]); 
                    }  
                }
            } 

           
       
            if( !is_null($faltacompletar) ){

                $montoabonar = 20 - ($faltacompletar->Ipo_Monto + $monto);

                if( $montoabonar >= 0 ){
                    if($montoabonar == 0){
                        $faltacompletarupdate->update([ 
                            "Ipo_Monto" => 20,
                            'Msa_SinIngreso'=> 'Y',
                            "Iah_Id"=> $ingresoHistorial->Iah_Id
                        ]);
                    }else{
                        $faltacompletarupdate->update([ 
                            "Ipo_Monto" => $faltacompletar->Ipo_Monto + $monto,
                            "Iah_Id"=> $ingresoHistorial->Iah_Id
                        ]);
                    }
                    
                  
                }else{
                    $montoa = 20 - $faltacompletar->Ipo_Monto;
                    $montob = $monto - $montoa;
                    $cuantosveintes = $montob  / 20; 
                    $restante = $montob - intval($cuantosveintes)*20;

                    if( is_double($cuantosveintes) ){
                        
                        for ($i=$faltacompletar->Msa_Id; $i < $faltacompletar->Msa_Id + intval($cuantosveintes) + 1; $i++) { 
                            $cambiar = ingresosAportaciones::where('Msa_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                            
                            $cambiar->update([ 
                                "Ipo_Monto" => 20.00,
                                "Msa_SinIngreso"=>"Y",
                                "Iah_Id"=> $ingresoHistorial->Iah_Id
                            ]); 
                        }  

                        $cambiar = ingresosAportaciones::where('Msa_Id', $faltacompletar->Msa_Id + intval($cuantosveintes) + 1)->where( 'Al_Id', $Datax["Al_Id"]);
                        $cambiar->update([ 
                            "Ipo_Monto" =>$restante,
                            "Msa_SinIngreso"=>"F",
                            "Iah_Id"=> $ingresoHistorial->Iah_Id
                        ]);
                         
                    }else{

                        for ($i=$faltacompletar->Msa_Id; $i < $faltacompletar->Msa_Id + intval($cuantosveintes) + 1; $i++) { 
                            $cambiar = ingresosAportaciones::where('Msa_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                            
                            $cambiar->update([ 
                                "Ipo_Monto" => 20.00,
                                "Msa_SinIngreso"=>"Y",
                                "Iah_Id"=> $ingresoHistorial->Iah_Id
                            ]); 
                        }   

                    }
                } 
          
            }else{
                
                $cuantosveintes = $monto  / 20;
                $restante = $monto - intval($cuantosveintes)*20;
              
                if (is_double($cuantosveintes) ){

                    for ($i=(10-count($all)); $i < (10-count($all)) + intval($cuantosveintes) +1 + 1; $i++) { 
                        $cambiar = ingresosAportaciones::where('Msa_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                        
                        $cambiar->update([ 
                            "Ipo_Monto" => 20.00,
                            "Msa_SinIngreso"=>"Y",
                            "Iah_Id"=> $ingresoHistorial->Iah_Id
                        ]); 
                    }  
                    $cambiar = ingresosAportaciones::where('Msa_Id', (10-count($all)) + intval($cuantosveintes) +1)->where( 'Al_Id', $Datax["Al_Id"]);
                    $cambiar->update([ 
                        "Ipo_Monto" =>$restante,
                        "Msa_SinIngreso"=>"F",
                        "Iah_Id"=> $ingresoHistorial->Iah_Id
                    ]);
                     
                }else{
                    for ($i=(10-count($all)); $i < (10-count($all)) + intval($cuantosveintes) +1 ; $i++) { 
                        $cambiar = ingresosAportaciones::where('Msa_Id',$i)->where( 'Al_Id', $Datax["Al_Id"]);
                        
                        $cambiar->update([ 
                            "Ipo_Monto" => 20.00,
                            "Msa_SinIngreso"=>"Y",
                            "Iah_Id"=> $ingresoHistorial->Iah_Id
                        ]); 
                    }  
                    
                }
            }
 
            return response()
                ->json([
                    "message" => "La aportaciones se registro correctamente",
                    "error" => "",
                    "success" => true,
                    "data" => ""
                ]); 
 

            /*$ingresos = ingresosAportaciones::
                create([
                    "Msa_Id" => 2,
                    "Al_Id" => $Datax["Al_Id"],
                    "Ipo_Monto" => 20
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
                    "error" =>  "",
                    "success" => false,
                    "data" => ""
                ]); 
        }
    }
  

}
