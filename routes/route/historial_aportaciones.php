<?php

use App\Http\Controllers\ingresos_aportaciones_historial_controller; 
use Illuminate\Support\Facades\Route;
  
Route::middleware('auth:sanctum')->get("/historial/historial",[ingresos_aportaciones_historial_controller::class,"historial"]); 
Route::middleware('auth:sanctum')->get("/historial/egresos",[ingresos_aportaciones_historial_controller::class,"egresos"]); 
Route::middleware('auth:sanctum')->post("/historial/egresos/add",[ingresos_aportaciones_historial_controller::class,"add_egreso"]); 

Route::middleware('auth:sanctum')->get("/historial/egresos_totales",[ingresos_aportaciones_historial_controller::class,"egresos_totales"]); 
Route::middleware('auth:sanctum')->get("/historial/ingresos_totales",[ingresos_aportaciones_historial_controller::class,"ingresos_totales"]); 
Route::middleware('auth:sanctum')->get("/historial/caja_total",[ingresos_aportaciones_historial_controller::class,"caja_total"]); 

Route::middleware('auth:sanctum')->post("/historial/egresos/show",[ingresos_aportaciones_historial_controller::class,"show_egreso"]); 

Route::get("/export_aportaciones_excel",[ingresos_aportaciones_historial_controller::class,"export_aportaciones_excel"]); 