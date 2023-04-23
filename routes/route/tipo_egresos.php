<?php 
 
use App\Http\Controllers\ingresosAportacionesController;
use App\Http\Controllers\tipo_egreso_controller;
use Illuminate\Support\Facades\Route; 

Route::middleware('auth:sanctum')->get("/tipo_egresos/all",[tipo_egreso_controller::class,"all"]); 