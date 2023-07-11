<?php

use App\Http\Controllers\inventario_controller;
use Illuminate\Support\Facades\Route;
  
Route::post("/inventario/search_inventario",[inventario_controller::class,"search_inventario"]);
Route::post("/inventario/show_material",[inventario_controller::class,"show_material"]);
Route::post("/inventario/add_material",[inventario_controller::class,"add_material"]);
Route::post("/inventario/edit_material",[inventario_controller::class,"edit_material"]);
Route::post("/inventario/aumentar_material",[inventario_controller::class,"aumentar_material"]);
Route::post("/inventario/disminuir_material",[inventario_controller::class,"disminuir_material"]);

Route::post("/inventario/show_control_inventario",[inventario_controller::class,"show_control_inventario"]);
Route::post("/inventario/delete_control_inventario",[inventario_controller::class,"delete_control_inventario"]);
Route::post("/inventario/actualizar_estado_no_contable",[inventario_controller::class,"actualizar_estado_no_contable"]);
 
//se envia los datos del modelo consultorio para que lo consuma un drownup para una seleccionar para poder crear un inventario
Route::get("/inventario/all_grupo_inventario",[inventario_controller::class,"all_grupo_inventario"]);