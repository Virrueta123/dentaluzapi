<?php

namespace App\Http\Controllers;

use App\Models\tipocuentas;
use Illuminate\Http\Request;
use Throwable;

class forma_pago_controller extends Controller
{
    public function all( /* get */ ){ 
        try {
            $tipocuentas = tipocuentas::all();
            return response()
                ->json([
                    "message" => "cofiguraciones cargado exitosamente ",
                    "error" => "error",
                    "success" => true,
                    "data" => $tipocuentas
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
}
