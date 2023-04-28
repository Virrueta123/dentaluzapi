<?php

use App\Http\Controllers\ingresos_aportaciones_historial_controller;
use App\Http\Controllers\promocion_controller;
use Illuminate\Support\Facades\Route;
  
Route::get("/promocion/script_add_meses",[promocion_controller::class,"script_add_meses"]); 

Route::post("/promocion/monto_actual_por_alumno",[promocion_controller::class,"monto_actual_por_alumno"]);

Route::post("/promocion/add_aportaciones",[promocion_controller::class,"add_aportaciones"]); 

Route::get("/promocion/historial",[promocion_controller::class,"historial"]); 

Route::get("/promocion/egresos",[promocion_controller::class,"egresos"]); 

Route::post("/promocion/egresos/add",[promocion_controller::class,"add_egreso"]); 

Route::get("/promocion/egresos_totales",[promocion_controller::class,"egresos_totales"]); 

Route::get("/promocion/ingresos_totales",[promocion_controller::class,"ingresos_totales"]); 

Route::get("/promocion/caja_total",[promocion_controller::class,"caja_total"]); 

Route::post("/promocion/egresos/show",[promocion_controller::class,"show_egreso"]); 

Route::get("/export_promocion_excel",[promocion_controller::class,"export_aportaciones_excel"]);
 
Route::get("/promocion_reporte_por_alumno/{id}",[promocion_controller::class,"promocion_reporte_por_alumno"]); 

