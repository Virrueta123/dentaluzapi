<?php 
use App\Http\Controllers\alumnosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\citasController;
use App\Http\Controllers\ingresosAportacionesController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\tratamientoController;
use App\Models\alumnos;
use App\Models\ingresosAportaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
Route::middleware('auth:sanctum')->post("/ingresos_aportaciones/monto_actual_por_alumno",[ingresosAportacionesController::class,"monto_actual_por_alumno"]);
Route::middleware('auth:sanctum')->post("/ingresos_aportaciones/add_aportaciones",[ingresosAportacionesController::class,"add_aportaciones"]); 
Route::middleware('auth:sanctum')->post("/ingresos_aportaciones/script_add_meses",[ingresosAportacionesController::class,"script_add_meses"]); 