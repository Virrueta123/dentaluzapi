<?php

namespace App\Http\Controllers;

use App\Models\tipo_egreso;
use Illuminate\Http\Request;
use Throwable;

class tipo_egreso_controller extends Controller
{
    public function all(){
        try {
            $get = tipo_egreso::where("Teg_active","A")->orderBy("Teg_Id", 'asc')->get();
 
            return response()
                ->json([
                    "message" => "tipos de egresos cargado exitosamente ",
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
}
