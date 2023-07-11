<?php

use App\Http\Controllers\tratamiento_precio_controller;
 
use Illuminate\Support\Facades\Route; 

Route::get("/tratamiento_precio/search",[tratamiento_precio_controller::class,"search"]);
Route::get("/tratamiento_precio/search_plan_tratamiento",[tratamiento_precio_controller::class,"search_plan_tratamiento"]);