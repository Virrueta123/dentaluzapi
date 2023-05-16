<?php  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tratamientoController;
 
Route::post("/tratamientos/showbypx",[tratamientoController::class,"showbypx"]);
Route::post("/tratamientos/create",[tratamientoController::class,"create"]);