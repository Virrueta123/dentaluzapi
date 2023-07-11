<?php

namespace App\Http\Controllers;

use App\Models\persona_nota;
use App\Models\personas;
use App\Models\unidad_didactica;
use App\Models\unidad_didactica_notas;
use App\Models\unidades;
use Illuminate\Http\Request;
use Throwable;

class generar_json_controller extends Controller
{ 
    function insertar_unidades_personas(Request $req){ 
        try {
            
            $persona = personas::all();
            $unidades = unidades::all();
            $conteo = 0;
            $json_persona = '';
            foreach ($persona as $per) { 
                foreach ($unidades as $ud) {
                    $unidad_didactica = new unidad_didactica();
                    $unidad_didactica->Perx_Id = $per->Perx_Id;
                    $unidad_didactica->nombre_unidad_didactica = $ud->nombre;
                    
                    if ($unidad_didactica->save()) {
                        $conteo++;
                    }  
                }
            } 

            return response() 
            ->json([
                "message"=>$json_persona, 
                "error"=>"",
                "success"=>false,
                "data"=>  $conteo 
            ]); 

        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => "algo salio mal",
                    "success" => false,
                    "data" => ""
                ]); 
        } 
    }


    function insertar_unidades_personas_nota(Request $req){ 
        try {
            
            $persona = persona_nota::all(); 
            $conteo = 0;
            $json_persona = '';
            foreach ($persona as $per) { 
                $unidad_didactica = new unidad_didactica_notas();
                $unidad_didactica->Pnx_Id = $per->Pnx_Id;
                $unidad_didactica->nombre_unidad_didactica =$per->ANATOMIAHUMANA;
                $unidad_didactica->nota =$per->ANATOMIAHUMANANOTA;
                
                if($unidad_didactica->save()){ 
                    $conteo++;
                }
                
                $unidad_didactica = new unidad_didactica_notas();
                $unidad_didactica->Pnx_Id = $per->Pnx_Id;
                $unidad_didactica->nombre_unidad_didactica =$per->BIOLOGIAGENERAL;
                $unidad_didactica->nota =$per->BIOLOGIAGENERALNOTA;

                if($unidad_didactica->save()){ 
                    $conteo++;
                }
                
                $unidad_didactica = new unidad_didactica_notas();
                $unidad_didactica->Pnx_Id = $per->Pnx_Id;
                $unidad_didactica->nombre_unidad_didactica =$per->PSICOLOGIAGENERALYEVOLUTIVA;
                $unidad_didactica->nota =$per->PSICOLOGIAGENERALYEVOLUTIVANOTA;

                if($unidad_didactica->save()){ 
                    $conteo++;
                }

                $unidad_didactica = new unidad_didactica_notas();
                $unidad_didactica->Pnx_Id = $per->Pnx_Id;
                $unidad_didactica->nombre_unidad_didactica =$per->BIOFISICA;
                $unidad_didactica->nota =$per->BIOFISICANOTA;

                if($unidad_didactica->save()){ 
                    $conteo++;
                }

                $unidad_didactica = new unidad_didactica_notas();
                $unidad_didactica->Pnx_Id = $per->Pnx_Id;
                $unidad_didactica->nombre_unidad_didactica =$per->QUIMICAGENERAL;
                $unidad_didactica->nota =$per->QUIMICAGENERALNOTA;

                if($unidad_didactica->save()){ 
                    $conteo++;
                }

                $unidad_didactica = new unidad_didactica_notas();
                $unidad_didactica->Pnx_Id = $per->Pnx_Id;
                $unidad_didactica->nombre_unidad_didactica =$per->FUNDAMENTOSDEENFERMERIAI;
                $unidad_didactica->nota =$per->FUNDAMENTOSDEENFERMERIAINOTA;

                if($unidad_didactica->save()){ 
                    $conteo++;
                }

                $unidad_didactica = new unidad_didactica_notas();
                $unidad_didactica->Pnx_Id = $per->Pnx_Id;
                $unidad_didactica->nombre_unidad_didactica =$per->COMUNICACION;
                $unidad_didactica->nota =$per->COMUNICACIONNOTA; 

                if($unidad_didactica->save()){ 
                    $conteo++;
                }
            } 

            return response() 
            ->json([
                "message"=>$json_persona, 
                "error"=>"",
                "success"=>false,
                "data"=>  $conteo 
            ]); 

        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => "algo salio mal",
                    "success" => false,
                    "data" => ""
                ]); 
        } 
    }

    function matricula(Request $req){ 
        try { 
            $consulta = personas::with(['unidad_didactica' => function ($query) {
                $query->select('*','nombre_unidad_didactica', 'nota');
            }])->limit(40)->get();

            foreach ($consulta as $con) {
                $con['sexo'] = $con['sexo'] == "F" ? "FEMENINO" : "MASCULINO";
                $con['tiene_discapacidad'] = $con['tiene_discapacidad'] == 0 ? false : true;
            }

            return response() 
            ->json([
                $consulta
            ]); 

        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => "algo salio mal",
                    "success" => false,
                    "data" => ""
                ]); 
        } 
    }

    function nota(Request $req){ 
        try { 
            $consulta = persona_nota::with(['unidad_didactica' => function ($query) {
                $query->select('*','nombre_unidad_didactica', 'nota');
            }])->limit(40)->get();

            foreach ($consulta as $con) {
                $con['sexo'] = $con['sexo'] == "F" ? "FEMENINO" : "MASCULINO";
                $con['tiene_discapacidad'] = $con['tiene_discapacidad'] == 0 ? false : true;
                $con['edad'] = $con['edad'] == 0 ? false : true;
            }

            

            return response() 
            ->json([
                $consulta
            ]); 

        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => "algo salio mal",
                    "success" => false,
                    "data" => ""
                ]); 
        } 
    }


}
