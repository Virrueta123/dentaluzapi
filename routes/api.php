<?php

use App\Http\Controllers\alumnosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\citasController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\tratamientoController;
use App\Http\Controllers\consulta_controller;
use App\Models\alumnos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
});

// rutas para las aportaciones del padua

include_once 'route/padua.php';

// 

// todas las configuraciones del proyecto

include_once 'route/configuraciones.php';

// fin


// todas las rutas para el historial

include_once 'route/historial_aportaciones.php';

// fin

// todas las rutas para el historial_promocion

include_once 'route/historial_promocion.php';

// fin

// todas las rutas para el historial

include_once 'route/tipo_egresos.php';

// fin

// todas las rutas para el tipo de pago

include_once 'route/forma_pago.php';

// fin

// todas las rutas para consultas a apis

include_once 'route/consulta_api.php';

// fin



Route::get("/pacientes",[pacienteController::class,"all"]);
Route::post("/pacientes/dropdownsearch",[pacienteController::class,"dropdownsearch"]);
Route::post("/pacientes/show",[pacienteController::class,"show"]);
Route::post("/pacientes/searchbyhx",[pacienteController::class,"searchbyhx"]);

//aportaciones
Route::post("/alumnos/dropdownsearch",[alumnosController::class,"dropdownsearch"]);

Route::post("users/tokennotification",[AuthController::class,"tokenNotification"]);

Route::post("/citas/showcitasdrx",[citasController::class,"showcitasdrx"]);
Route::post("/citas/showcitasdrxall",[citasController::class,"showcitasdrxall"]);
Route::post("/citas/createcita",[citasController::class,"createCita"]);
Route::post("/citas/all",[citasController::class,"all"]);
Route::post("/citas/seleccionSemanaCita",[citasController::class,"seleccionSemanaCita"]);
Route::post("/citas/showcita",[citasController::class,"showcita"]);
Route::delete("/citas/delete/{id}",[citasController::class,"delete"]);

Route::post("/users/alldoctor",[AuthController::class,"allDoctor"]);

Route::post("/tratamientos/showbypx",[tratamientoController::class,"showbypx"]);


Route::get("/productos",[productoController::class,"all"]);

Route::post("/productos",[productoController::class,"store"]);

Route::delete("/productos/{id}",[productoController::class,"destroy"]);

Route::post("users/login",[AuthController::class,"login"]);

Route::get("users/usertype",[AuthController::class,"usertype"]);

/*
Route::middleware('auth:sanctum')->get("/pacientes",[pacienteController::class,"all"]);
Route::middleware('auth:sanctum')->post("/pacientes/dropdownsearch",[pacienteController::class,"dropdownsearch"]);
Route::middleware('auth:sanctum')->post("/pacientes/show",[pacienteController::class,"show"]);
Route::middleware('auth:sanctum')->post("/pacientes/searchbyhx",[pacienteController::class,"searchbyhx"]);

//aportaciones
Route::middleware('auth:sanctum')->post("/alumnos/dropdownsearch",[alumnosController::class,"dropdownsearch"]);

Route::middleware('auth:sanctum')->post("users/tokennotification",[AuthController::class,"tokenNotification"]);

Route::middleware('auth:sanctum')->post("/citas/showcitasdrx",[citasController::class,"showcitasdrx"]);
Route::middleware('auth:sanctum')->post("/citas/createcita",[citasController::class,"createCita"]);
Route::middleware('auth:sanctum')->post("/citas/all",[citasController::class,"all"]);
Route::middleware('auth:sanctum')->post("/citas/showcita",[citasController::class,"showcita"]);
Route::middleware('auth:sanctum')->delete("/citas/delete/{id}",[citasController::class,"delete"]);

Route::middleware('auth:sanctum')->post("/users/alldoctor",[AuthController::class,"allDoctor"]);

Route::middleware('auth:sanctum')->post("/tphp artisan make:controller tipo_egreso_controllerratamientos/showbypx",[tratamientoController::class,"showbypx"]);

*/