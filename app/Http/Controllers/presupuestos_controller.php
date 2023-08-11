<?php

namespace App\Http\Controllers;
 
use App\Models\detalleprovicional;
use App\Models\preprovicional_model;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class presupuestos_controller extends Controller
{
	public function crear(Request $Req)
	{

		try {

			$data = $Req->all();
			$data_presupuesto = json_encode($data["data_presupuesto"]);

			$prepro = preprovicional_model::where("Px_Id", $data["id_px"])->orderBy('Prep_Id', 'DESC')->first();

			$lote = 0;

			if (empty($prepro)) {
				$lote = 1;
			} else {
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

					$registro = new detalleprovicional();
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
					"message" => "error al crear el presupuesto =>" . $e,
					"error" => "error",
					"success" => false,
					"data" => "",
				]);
			Log::error($e);
		}
	}

	public function editar(Request $Req)
	{

		try {

			$data = $Req->all();
			$presupuesto =  $data["presupuesto"];
   
			$prepro = preprovicional_model::where("Prep_Id", $presupuesto["Prep_Id"]);
			$update = $prepro->update([
				"descripcion" => $data["descripcion"],
				"Pred_Fecha" => Carbon::now(),
				"Pred_TotalAfter" => $data["total_presupuesto"],
				"Pred_Descuento" => $data["porcentaje"],
				"Pred_DescuentoV" => $data["total_presupuesto"] - $data["total_presupuesto_descuento"],
				"Pred_Total" => $data["total_presupuesto_descuento"],
				"Dox_Id" => $data["doctor_id"],
			]); 

			if ($update) {

				$array_id_antiguo = array();
				$array_id_nuevo = array();
				$detalle_presupuesto_antiguo = detalleprovicional::where("Prep_Id", $presupuesto["Prep_Id"])->get();
  
				foreach ($detalle_presupuesto_antiguo as $dta) {
						array_push($array_id_antiguo, $dta["Prepd_Id"]);
				}

				foreach ($data["data_presupuesto_editar"] as $dtp) { 
					if (strpos($dtp["Prepd_Id"], 'n') !== false) {
						  
					} else {
						array_push($array_id_nuevo, $dtp["Prepd_Id"]);
					}
				} 
 
				$eliminar = array_diff($array_id_antiguo,$array_id_nuevo);

				$delete = detalleprovicional::whereIn('Prepd_Id', $eliminar)->delete();

				 

				foreach ($data["data_presupuesto_editar"] as $dtp) { 
					if (strpos($dtp["Prepd_Id"], 'n') !== false) {
						 
						$registro = new detalleprovicional();
						$registro->Prep_Id = $presupuesto["Prep_Id"];
						$registro->Ptxd_Id = $dtp["preciotx"]["Ptxd_Id"];
						$registro->Prep_Clasificacion = $dtp["Prep_Clasificacion"];
						$registro->Prep_Clasificacion_valores = $dtp["Prep_Clasificacion_valores"];
						$registro->Prep_Punit = $dtp["Prep_Punit"];
						$registro->Prep_Subtotal = $dtp["Prep_Subtotal"];
						$registro->Prep_Cantidad = $dtp["Prep_Cantidad"];
						$registro->save();

					} else {
						 
						$prepro = detalleprovicional::where("Prepd_Id", $dtp["Prepd_Id"]);
						$update = $prepro->update([
							"Ptxd_Id" => $dtp["preciotx"]["Ptxd_Id"],
							"Prep_Clasificacion" => $dtp["Prep_Clasificacion"],
							"Prep_Clasificacion_valores" => $dtp["Prep_Clasificacion_valores"],
							"Prep_Punit" => $dtp["Prep_Punit"],
							"Prep_Subtotal" => $dtp["Prep_Subtotal"],
							"Prep_Cantidad" => $dtp["Prep_Cantidad"]
						]);  
					}
				} 
				return response()
					->json([
						"message" => "se creo correctamente el presupuesto",
						"error" => "",
						"success" => true,
						"data" => $presupuesto["Prep_Id"],
					]);
			} else {
				return response()
					->json([
						"message" => "el presupuesto no creo correctamente",
						"error" => "error",
						"success" => false,
						"data" => "",
					]);
			}
		} catch (Exception $e) {
			return response()
				->json([
					"message" => "error al crear el presupuesto =>" . $e,
					"error" => "error",
					"success" => false,
					"data" => "",
				]);
			Log::error($e);
		}
	}
}
