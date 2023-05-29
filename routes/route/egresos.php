<?php

use App\Http\Controllers\egresos_controller;
use Illuminate\Support\Facades\Route;
  
Route::post("/egresos/crear_egreso",[egresos_controller::class,"crear_egreso"]);  