<?php

use App\Http\Controllers\presupuestos_controller;
use Illuminate\Support\Facades\Route; 

Route::post("/presupuesto/crear",[presupuestos_controller::class,"crear"]); 
Route::post("/presupuesto/editar",[presupuestos_controller::class,"editar"]);  