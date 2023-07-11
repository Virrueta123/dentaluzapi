<?php

namespace App\Http\Controllers;

use App\Models\tratamientos_precio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tratamiento_precio_controller extends Controller
{
    public function  search(){  
        
        $tratamientos_precio = tratamientos_precio::
                    select(DB::raw("CONCAT(Ptxd_Id,'-', Ptxd_Precio,'-',Ptxd_Nombre,'-',Ptxd_Clasificacion) AS id"),"Ptxd_Nombre",DB::raw("CONCAT(Ptxd_Nombre,' ', Ptxd_Precio) AS name"))
                    ->where('Ptxd_Nombre', 'like', '%'.request()->get('search').'%') 
                    ->limit(7)
                    ->get();
        echo json_encode($tratamientos_precio); 
    }

    public function  search_plan_tratamiento(){  
        
        $tratamientos_precio = tratamientos_precio::
                    select(DB::raw("Ptxd_Id AS id"),"Ptxd_Nombre",DB::raw("Ptxd_Nombre AS name"))
                    ->where('Ptxd_Nombre', 'like', '%'.request()->get('search').'%') 
                    ->limit(7)
                    ->get();
        echo json_encode($tratamientos_precio); 
    }
}
