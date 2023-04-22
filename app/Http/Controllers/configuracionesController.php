<?php

namespace App\Http\Controllers;

use App\Models\configuraciones;
use Illuminate\Http\Request;
use Throwable;

class configuracionesController extends Controller
{
    public function monto_total_aportaciones( /* get */ ){
      
        try {
            $cofiguraciones = configuraciones::where("Cof_Item","monto_total_aportaciones")->first();
            return response()
                ->json([
                    "message" => "cofiguraciones cargado exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $cofiguraciones->Cof_Valor
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
}
