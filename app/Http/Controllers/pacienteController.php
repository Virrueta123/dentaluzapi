<?php

namespace App\Http\Controllers;

use App\Models\pacientes;
use Illuminate\Http\Request;

class pacienteController extends Controller
{
    public function all(){
        echo pacientes::all();
    }
    public function dropdownsearch(Request $req){

        $pacientes = pacientes::
                     with("doctor")
                    ->where('Px_Nombre', 'like', '%'.$req->all()["search"].'%')
                    ->orWhere('Px_Apellido', 'like', '%'.$req->all()["search"].'%')
                    ->orWhere('Px_Dni', 'like', '%'.$req->all()["search"].'%')
                    ->orWhere('Px_Historia', 'like', '%'.$req->all()["search"].'%') 
                    ->limit(7)
                    ->get();

        return response() 
        ->json([
            "message"=>"pacientes cargados exitosamente ", 
            "error"=>"",
            "success"=>true,
            "data"=> $pacientes
        ]); 

    }
  
    public function searchbyhx(Request $req){

    $Datax = $req->all();
    $paciente = pacientes::
          where("Px_Historia",$Datax["Px_Historia"])
        ->where("Px_IdDoctor",$Datax["Px_IdDoctor"])
        ->first();

    return response() 
    ->json([
        "message"=>"pacientecargado exitosamente ", 
        "error"=>"",
        "success"=>true,
        "data"=> $paciente
        ]); 
    }

    public function show(Request $req){ 

      $pacientes = pacientes::
          with("doctor")
      ->where('Px_Id', $req->all()["Px_Id"])
      ->first();
      
      $edad = \Carbon\Carbon::parse($pacientes["Px_FechaNac"])->age;

      $pacientes["pxEdad"] = $edad;

    return response() 
    ->json([
        "message"=>"paciente cargado exitosamente ", 
        "error"=>"",
        "success"=>true,
        "data"=> $pacientes
        ]); 
    }
}
