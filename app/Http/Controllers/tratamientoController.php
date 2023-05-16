<?php

namespace App\Http\Controllers;

use App\Models\fechacaja;
use App\Models\tratamientos;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\helper_controller;

class tratamientoController extends Controller {
    
	public function showbypx(Request $req) {
		$datax = $req->all();
		$tratamientos = tratamientos::
			with("doctor")
			->with("usuario")
			->with("tipocuenta")
			->where('Tx_Px_Id', $datax["Px_Id"])
			->get();
		return response()
			->json([
				"message" => "tratamientos cargados exitosamente ",
				"error" => "error",
				"success" => true,
				"data" => $tratamientos,
			]);
	}

	public function create(Request $Req) {

		try {
			$data = $Req->all();  
			$Plantratamiento = new tratamientos();
			$Plantratamiento->Tx_Descripcion = $data["Tx_Descripcion"];
			$Plantratamiento->Tx_fecha = helper_controller::fechaactual();
			$Plantratamiento->Tx_monto = $data["Tx_monto"];
			$Plantratamiento->Tx_TipoPago_Id = $data["tipopago"];
			// Asignacion del valor al tipo de pago 1 = a ningun tipo de cuenta
			$Plantratamiento->Tx_Cuenta_Id = $data["cuenta"];
			$Plantratamiento->Tx_Px_Id = $data["Px_Id"];
			$Plantratamiento->Tx_Doc_Id = $data["Dx_Id"];
			$Plantratamiento->Tx_User_Id = $data["Us_Id"];

			$PlantratamientoCreado = $Plantratamiento->save();
                         
			if ($PlantratamientoCreado) {
				 
                             // registrar si ese dia se atendio o hubo gastos
                             $fechacaja = new fechacaja();
                             $regis = $fechacaja->crear($data["Tx_monto"], "ingreso"); 
                             return response()
				->json([
					"message" => "se creo correctamente el tratamiento",
					"error" => "",
					"success" => true,
					"data" => "",
				]);
                                   
			}

		} catch (Exception $e) {
			return response()
				->json([
					"message" => "error al crear el tratamiento",
					"error" => "error",
					"success" => false,
					"data" => "",
				]);
                        Log::error($e);
		}

	}
}
