<?php

use App\Http\Controllers\inventario_controller;
use Illuminate\Support\Facades\Route;
  
Route::post("/inventario/search_inventario",[inventario_controller::class,"search_inventario"]);
Route::post("/inventario/show_material",[inventario_controller::class,"show_material"]);
Route::post("/inventario/add_material",[inventario_controller::class,"add_material"]);
Route::post("/inventario/aumentar_material",[inventario_controller::class,"aumentar_material"]);
Route::post("/inventario/disminuir_material",[inventario_controller::class,"disminuir_material"]);

//se envia los datos del modelo consultorio para que lo consuma un drownup para una seleccionar para poder crear un inventario
Route::get("/inventario/all_grupo_inventario",[inventario_controller::class,"all_grupo_inventario"]);