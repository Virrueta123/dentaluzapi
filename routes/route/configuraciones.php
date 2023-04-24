<?php 
use App\Http\Controllers\alumnosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\citasController;
use App\Http\Controllers\configuracionesController;
use App\Http\Controllers\ingresosAportacionesController;
use App\Http\Controllers\pacienteController;
use App\Http\Controllers\productoController;
use App\Http\Controllers\tratamientoController;
use App\Models\alumnos;
use App\Models\confirguraciones;
use App\Models\ingresosAportaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
Route::get("/configuracion/monto_total_aportaciones",[configuracionesController::class,"monto_total_aportaciones"]); 