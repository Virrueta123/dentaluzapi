<?php  
use App\Http\Controllers\configuracionesController; 
use Illuminate\Support\Facades\Route;
  
Route::get("/configuracion/monto_total_aportaciones",[configuracionesController::class,"monto_total_aportaciones"]); 
Route::get("/configuracion/monto_total_promocion",[configuracionesController::class,"monto_total_promocion"]); 