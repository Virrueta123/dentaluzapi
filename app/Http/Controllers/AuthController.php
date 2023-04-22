<?php

namespace App\Http\Controllers;

use App\Models\User;
 
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;  
class AuthController extends Controller
{   
   public function usertype(){
        return User::with("usertype")->get();
   }

   public function allDoctor(){
  
    $Doctores = User::where("isDoctor","Y")->get();
    return response() 
    ->json([
        "message"=>"Docotores cargados exitosamente ", 
        "error"=>"",
        "success"=>true,
        "data"=> $Doctores
        ]); 
   } 

   public function login(Request $request){

    if(!Auth::attempt($request->only("username","password")))
    { 
        return response()
                ->json([
                "message"=>"usuario no autorizado",
                "error"=>"usuario no autorizado",
                "success"=>false
                ],"401");
    } 
    $user = User::where("username",$request["username"])->firstOrFail();
    
    $token = $user->createToken("auth_token")->plainTextToken;

    $userData = User::with("usertype")->where("username",$request["username"])->firstOrFail();

    $userData["token"]=$token;
    
    return response() 
    ->json([
        "message"=>"Bienvenida " . $user->name, 
        "error"=>"",
        "success"=>true,
        "data"=> $userData
        ]); 
   } 

   public function tokenNotification(Request $request){
        
       $user = User::where("id",$request->all()["id_user"]);
       $user->update(
        [
            "token_notification"=> $request->all()["token_notification"]
        ]
        );
        
        return response() 
               ->json([
                    "message"=>"actulizacion exitosa", 
                    "error"=>"",
                    "success"=>true  
               ]); 
   }
}
