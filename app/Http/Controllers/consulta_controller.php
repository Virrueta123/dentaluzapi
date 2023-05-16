<?php

namespace App\Http\Controllers;
use Peru\Jne\DniFactory;
use Illuminate\Http\Request;
use Throwable;

class consulta_controller extends Controller
{
    public function buscardni(Request $req){
      
        try { 
            $req = $req->all();
            $dni = $req["dni"];

            $factory = new DniFactory();
            $cs = $factory->create();

            $person = $cs->get($dni);
            if (!$person) {
                return response()
                ->json([
                    "message" => "no exite usuario",
                    "error" => "error",
                    "success" => false,
                    "data" => ""
                ]);  
            }else{
                return response()
                ->json([
                    "message" => "cofiguraciones cargado exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $person
                ]); 
            } 

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
