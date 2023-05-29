<?php

namespace App\Http\Controllers;

use App\Models\egresos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class egresos_controller extends Controller
{
    function crear_egreso(Request $request){
        try {
            // Crea un nuevo registro con los datos recibidos en la solicitud
            $registro = new egresos();
            $registro->Eg_Descripcion = $request->input('Eg_Descripcion');
            $registro->Eg_Tipa_id = $request->input('Eg_Tipa_id');
            $registro->Eg_Tita_id = $request->input('Eg_Tita_id');
            $registro->Eg_Teg_id = $request->input('Eg_Teg_id');
            $registro->Eg_Us_id = $request->input('Eg_Us_id');
            $registro->Eg_Fecha = $request->input('Eg_Fecha');
            $registro->Eg_Monto = $request->input('Eg_Monto');
            $registro->save(); 

            return response()
                    ->json([
                        "message" => "Se registro correctamente ",
                        "error" => "",
                        "success" => true,
                        "data" => ""
                    ], 201); 
        } catch (Throwable $e) {
            Log::error($e);
            return response()
                ->json([
                    "message" => "error =>".$e,
                    "error" => "error",
                    "success" => false,
                    "data" => ""
                ]); 
        } 
    }
}
