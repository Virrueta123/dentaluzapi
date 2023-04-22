<?php

namespace App\Http\Controllers;

use App\Models\tratamientos;
use Illuminate\Http\Request;

class tratamientoController extends Controller
{
    public function showbypx(Request $req){
        $datax = $req->all();
        $tratamientos = tratamientos::
          with("doctor")
        ->with("usuario")
        ->with("tipocuenta")
        ->where('Tx_Px_Id',$datax["Px_Id"])
        ->get();
    return response() 
    ->json([
        "message"=>"tratamientos cargados exitosamente ", 
        "error"=>"",
        "success"=>true,
        "data"=> $tratamientos
        ]); 
    }
}
