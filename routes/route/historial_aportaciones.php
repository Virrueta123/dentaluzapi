<?php

use App\Http\Controllers\ingresos_aportaciones_historial_controller; 
use Illuminate\Support\Facades\Route;
  
Route::get("/historial/historial",[ingresos_aportaciones_historial_controller::class,"historial"]); 

Route::get("/historial/egresos",[ingresos_aportaciones_historial_controller::class,"egresos"]); 

Route::post("/historial/egresos/add",[ingresos_aportaciones_historial_controller::class,"add_egreso"]); 

Route::get("/historial/egresos_totales",[ingresos_aportaciones_historial_controller::class,"egresos_totales"]); 

Route::get("/historial/ingresos_totales",[ingresos_aportaciones_historial_controller::class,"ingresos_totales"]); 

Route::get("/historial/caja_total",[ingresos_aportaciones_historial_controller::class,"caja_total"]); 

Route::post("/historial/egresos/show",[ingresos_aportaciones_historial_controller::class,"show_egreso"]); 

Route::get("/export_aportaciones_excel",[ingresos_aportaciones_historial_controller::class,"export_aportaciones_excel"]); 
Route::get("/aportaciones_apafa_reporte_por_alumno/{id}",[ingresos_aportaciones_historial_controller::class,"aportaciones_apafa_reporte_por_alumno"]); 
