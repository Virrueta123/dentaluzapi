<?php

namespace App\Http\Controllers;

use App\Models\detallepreprovicional_model;
use App\Models\preprovicional_model;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class presupuestos_controller extends Controller
{
    public function crear(Request $Req) {

		try {

			$data = $Req->all();  
			$data_presupuesto = json_encode($data["data_presupuesto"]);
			 
			$prepro = preprovicional_model::where("Px_Id",$data["id_px"])->orderBy('Prep_Id', 'DESC')->first();

			$lote=0;

			if(empty($prepro)){
				$lote = 1;
			}else{
				$lote = $prepro->Pred_Lote + 1; 
			}

			$preprovicional = new preprovicional_model();
			$preprovicional->Px_Id = $data["id_px"];
			$preprovicional->id = $data["user_id"];
			$preprovicional->Pred_Lote = $lote;
			$preprovicional->Pred_Fecha = Carbon::now();
			$preprovicional->Pred_TotalAfter = $data["total_presupuesto"];
			$preprovicional->Pred_Descuento = $data["porcentaje"];
			$preprovicional->Pred_DescuentoV = $data["total_presupuesto"] - $data["total_presupuesto_descuento"];
			$preprovicional->Pred_Total = $data["total_presupuesto_descuento"];
			$preprovicional->Dox_Id = $data["doctor_id"];
			$preprovicional->descripcion = $data["descripcion"];
		 
			if ($preprovicional->save()) {
				foreach ($data["data_presupuesto"] as $dtp) {
					
					$registro = new detallepreprovicional_model();
					$registro->Prep_Id = $preprovicional["Prep_Id"];
					$registro->Ptxd_Id = $dtp["id_tratamiento"];
					$registro->Prep_Clasificacion = $dtp["clasificacion"];
					$registro->Prep_Clasificacion_valores = $dtp["clasificacion_texto"];
					$registro->Prep_Punit = $dtp["precio"];
					$registro->Prep_Subtotal = $dtp["subtotal"];
					$registro->Prep_Cantidad = $dtp["cantidad"];  
					$registro->save();
				}
			 
            return response()
				->json([
					"message" => "se creo correctamente el presupuesto",
					"error" => "",
					"success" => true,
					"data" => $preprovicional->Prep_Id,
				]);                
			}

		} catch (Exception $e) {
			return response()
				->json([
					"message" => "error al crear el presupuesto =>".$e,
					"error" => "error",
					"success" => false,
					"data" => "",
				]);
          	Log::error($e);
		}

	}
}
