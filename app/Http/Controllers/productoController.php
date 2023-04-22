<?php

namespace App\Http\Controllers;

use App\Models\productos;
use Illuminate\Http\Request;

class productoController extends Controller
{
    public function all(){  
        return json_encode(productos::orderBy('id',"desc")->get()) ;
    }
    public function destroy( $id ){
        $delete = productos::where("id",$id)->delete();
        if($delete){
            return response()
            ->json([
                    "message"=>"registro eliminado correctamente",
                    "error"=>false  
                ]);
        }else{
            return response()
            ->json([
                    "message"=>"Error, no se elimino el registro",
                    "error"=>true
                ]);
        }
    }
    public function store(Request $request){
        $rev = $request->validate(
            [
                "descripcion"=>"required",
                "precio"=>"required" 
            ]
        );
         
        $created = productos::create($rev);
        
        if($created){
            return response()
            ->json([
                "message"=>"registro exitoso",
                "error"=>false  
                ]);
        }else{
            return response()
            ->json([
                "message"=>"fallo en el registro del producto",
                "error"=>true
                ]);
        }
    }
}
