<?php

namespace App\Http\Controllers;

use App\Models\citas;
use App\Models\pacientes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class citasController extends Controller
{
    

    public function delete($id){ 
   
        $citas = citas::where("Cx_Id",$id);
        $delete = $citas->delete();
        if($delete){
            return response() 
            ->json([
                "message"=>"se elimino la cita correctamente", 
                "error"=>"",
                "success"=>true,
            ]);
        }else{
            return response() 
            ->json([
                "message"=>"error, la cita no se elimino correctamente", 
                "error"=>"",
                "success"=>false,
            ]);
        }
        
    }

    public function showcitasdrx(Request $Datax){ 
        $Datax = $Datax->all();
        $citas = citas::
          with("pacientes")
        ->with("doctores")
        ->where("Cx_Id_doctor",$Datax["id_doctor"])
        ->where("Cx_Fecha",$Datax['todaySelect'])
        ->orderBy('Cx_Hora', 'asc')
        ->get();

        return response() 
    ->json([
        "message"=>"Citas cargadas correctamente", 
        "error"=>"",
        "success"=>true,
        "data"=> $citas
        ]);
    }

    public function showcita(Request $Datax){ 
        $Datax = $Datax->all();
        $citas = citas::
          with("pacientes")
        ->with("doctores")
        ->where("Cx_Id",$Datax["Cx_Id"])  
        ->first();

        return response() 
    ->json([
        "message"=>"Citas cargadas correctamente", 
        "error"=>"",
        "success"=>true,
        "data"=> $citas
        ]);
    }

    public function all(){
        $now = Carbon::now()->format("Y-m-d");
        $citas = citas::
        with("pacientes")
      ->with("doctor")->where("Cx_Fecha",">=",$now)->get();  
        return response()
        ->json([
        "message"=>"Citas cargadas correctamente", 
        "error"=>"",
        "success"=>true,
        "data"=> $citas
        ]);
    }

    public function createCita(Request $Datax){
        $Datax = $Datax->all();
        $horaFinal = Carbon::parse($Datax["hora"])->addMinutes($Datax["intervalo"]);
        $horaFinal = "{$horaFinal->hour}:{$horaFinal->minute}:00";

        $citas = citas::create([
            "Cx_Fecha" =>$Datax["fecha"],
            "Cx_Hora" => $Datax["hora"],
            "Cx_HoraEnd" =>  $horaFinal,
            "Cx_Descripcion" => $Datax["descripcion"],
            "Cx_Id_px" => $Datax["px"],
            "Cx_Id_doctor" => $Datax["doctor"],
            "Cx_Id_user" => $Datax["usuario"],
            "Cx_Historia" => $Datax["historia"] 
        ]);  
        return response()
            ->json([
            "message"=>"Citas cargadas correctamente", 
            "error"=>"",
            "success"=>true,
            "data"=> $citas
            ]);
         
    }
   
}
