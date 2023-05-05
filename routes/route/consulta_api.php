 <?php

use App\Http\Controllers\forma_pago_controller;
use Illuminate\Support\Facades\Route;
   
Route::post("/consulta_api/buscardni",[consulta_controller::class,"buscardni"]);