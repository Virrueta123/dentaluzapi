<?php

use App\Http\Controllers\forma_pago_controller;
use Illuminate\Support\Facades\Route;
  
Route::get("/forma_pago/all",[forma_pago_controller::class,"all"]); 