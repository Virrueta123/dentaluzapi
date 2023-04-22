<?php

namespace App\Http\Controllers;

use App\Models\alumnos;
use Illuminate\Http\Request;

class alumnosController extends Controller
{
    public function dropdownsearch(Request $req){
        $alumnos = alumnos::
          where('Al_Comodin', 'N')
        ->where('Al_Nombre', 'like', '%'.$req->all()["search"].'%')
        ->orWhere('Al_Apellido', 'like', '%'.$req->all()["search"].'%') 
        ->limit(7)
        ->get();
    return response() 
    ->json([
        "message"=>"alumnos cargados exitosamente ", 
        "error"=>"",
        "success"=>true,
        "data"=> $alumnos
        ]); 
    }
}
