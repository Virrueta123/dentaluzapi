<?php

namespace App\Http\Controllers;

use App\Models\preprovicional_model;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class presupuesto_controller extends Controller
{
    public function create(Request $Req) {

		try {
			$data = $Req->all();  
			$Plantratamiento = new preprovicional_model();
			$Plantratamiento->Tx_Descripcion = $data["Tx_Descripcion"];
			$Plantratamiento->Tx_fecha = helper_controller::fechaactual();
			$Plantratamiento->Tx_monto = $data["Tx_monto"];
			$Plantratamiento->Tx_fecha = $data["Tx_fecha"];
			$Plantratamiento->Tx_TipoPago_Id = $data["tipopago"]; 
			$Plantratamiento->Tx_Cuenta_Id = $data["cuenta"];
			$Plantratamiento->Tx_Px_Id = $data["Px_Id"];
			$Plantratamiento->Tx_Doc_Id = $data["Dx_Id"];
			$Plantratamiento->Tx_User_Id = $data["Us_Id"];

			$PlantratamientoCreado = $Plantratamiento->save();
                         
			if ($PlantratamientoCreado) {
			 
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
