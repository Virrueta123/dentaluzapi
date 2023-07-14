<?php

namespace App\Http\Controllers;

use App\Models\consultorio;
use App\Models\control_inventario;
use App\Models\inventario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class inventario_controller extends Controller
{
    function search_inventario(Request $req)
    {
        try {

            $iventarios = inventario::with(['control' => function ($query) {
                $query->select("*", DB::raw("SUM(CASE WHEN Cinx_Ingreso='DI' THEN Cinx_Cantidad ELSE 0 END) AS restar"), DB::raw("SUM(CASE WHEN Cinx_Ingreso='AU' THEN Cinx_Cantidad ELSE 0 END) AS sumar"))->groupBy('Inx_Id');
            }])->with("consultorio")
                ->where('Inx_Nombre', 'LIKE', '%' . $req->all()["search"] . '%')
                ->whereNotIn('Inx_IsLleno', ["V"])
                ->limit(7)
                ->get();


            return response()
                ->json([
                    "message" => "inventarios cargados exitosamente ",
                    "error" => "",
                    "success" => false,
                    "data" => $iventarios
                ]);
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>" . $e,
                    "error" => "algo salio mal",
                    "success" => false,
                    "data" => ""
                ]);
        }
    }

    function all_grupo_inventario()
    {

        try {

            $consultorios = consultorio::where("Cox_Active", "A")->get();

            if ($consultorios) {
                return response()
                    ->json([
                        "message" => "inventario registrado correctamente ",
                        "error" => "",
                        "success" => true,
                        "data" => $consultorios
                    ]);
            } else {
                return response()
                    ->json([
                        "message" => "algo paso, vuelva a intentar",
                        "error" => "",
                        "success" => false,
                        "data" => ""
                    ]);
            }
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "algo paso, vuelva a intentar",
                    "error" => "algo salio mal",
                    "success" => false,
                    "data" => ""
                ]);
        }
    }

    function add_material(Request $req)
    {

        try {

            $inventario = new inventario();
            $inventario->Inx_Nombre = $req->all()["Inx_Nombre"];
            $inventario->Inx_Cantidad = $req->all()["Inx_Cantidad"];
            $inventario->Inx_Contable = $req->all()["Inx_Contable"];
            $inventario->Inx_Lugar = $req->all()["Inx_Lugar"];
            $inventario->Cox_Id = $req->all()["Cox_Id"];
            $inventario->user_id = $req->all()["user_id"];
            $inventario->Inx_IsLleno = $req->all()["Inx_IsLleno"];
            $inventario->save();

            if ($inventario->save()) {
                return response()
                    ->json([
                        "message" => "inventario registrado correctamente ",
                        "error" => "",
                        "success" => true,
                        "data" => $inventario
                    ]);
            } else {
                return response()
                    ->json([
                        "message" => "algo paso, vuelva a intentar ",
                        "error" => "algo salio mal",
                        "success" => false,
                        "data" => $inventario
                    ]);
            }
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>",
                    "error" => "",
                    "success" => false,
                    "data" => ""
                ]);
        }
    }

    function edit_material(Request $req)
    {

        try {

            $inventario = inventario::where('Inx_Id', $req->all()["Inx_Id"])->first();
            $inventario->Inx_Nombre = $req->all()["Inx_Nombre"];
            $inventario->Inx_Cantidad = $req->all()["Inx_Contable"] == "N" ? $req->all()["Inx_Cantidad"] : 1;
            $inventario->Inx_Contable = $req->all()["Inx_Contable"];
            $inventario->Inx_Lugar = $req->all()["Inx_Lugar"];
            $inventario->Inx_IsLleno = $req->all()["Inx_IsLleno"];
            $inventario->Cox_Id = $req->all()["Cox_Id"];
            $inventario->user_id = $req->all()["user_id"];

            if ($inventario->save()) {
                return response()
                    ->json([
                        "message" => "inventario registrado correctamente ",
                        "error" => "",
                        "success" => true,
                        "data" => $inventario
                    ]);
            } else {
                return response()
                    ->json([
                        "message" => "algo paso, vuelva a intentar ",
                        "error" => "algo salio mal",
                        "success" => false,
                        "data" => $inventario
                    ]);
            }
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>",
                    "error" => "",
                    "success" => false,
                    "data" => ""
                ]);
        }
    }

    function actualizar_estado_no_contable(Request $req)
    {

        try {

            $inventario = inventario::where('Inx_Id', $req->all()["inx_id"])->first();
            $inventario->Inx_IsLleno = $req->all()["estado"];

            if ($inventario->save()) {
                return response()
                    ->json([
                        "message" => "estado actualizado correctamente ",
                        "error" => "",
                        "success" => true,
                        "data" => $inventario
                    ]);
            } else {
                return response()
                    ->json([
                        "message" => "algo paso, vuelva a intentar ",
                        "error" => "algo salio mal",
                        "success" => false,
                        "data" => $inventario
                    ]);
            }
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "algo paso, vuelva a intentar",
                    "error" => "",
                    "success" => false,
                    "data" => ""
                ]);
        }
    }

    function show_material(Request $req)
    {
        try {

            $iventario = inventario::with("consultorio")->with(['control' => function ($query) {
                $query->select("*", DB::raw("SUM(IF(Cinx_Ingreso='AU',Cinx_Cantidad,0)) AS sumar"), DB::raw("SUM(IF(Cinx_Ingreso='DI',Cinx_Cantidad,0)) AS restar"));
            }])
                ->where('Inx_Id', $req->all()["inx_id"])
                ->first();

            return response()
                ->json([
                    "message" => "iventarios cargados exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $iventario
                ]);
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>" . $e,
                    "error" => "algo salio mal",
                    "success" => false,
                    "data" => ""
                ]);
        }
    }



    function show_control_inventario(Request $req)
    {
        try {

            $iventario = control_inventario::where('Inx_Id', $req->all()["inx_id"])
                ->get();

            return response()
                ->json([
                    "message" => "control inventario cargados exitosamente ",
                    "error" => "",
                    "success" => true,
                    "data" => $iventario
                ]);
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>" . $e,
                    "error" => "algo salio mal",
                    "success" => false,
                    "data" => ""
                ]);
        }
    }

    function delete_control_inventario(Request $req)
    {
        try {

            $inventario = control_inventario::where('Cinx_id', $req->all()["Cinx_id"])
                ->delete();

            if ($inventario) {
                return response()
                    ->json([
                        "message" => "el registro se elimino exitosamente ",
                        "error" => "",
                        "success" => true,
                        "data" => ""
                    ]);
            } else {
                return response()
                    ->json([
                        "message" => "el registro no se elimino ",
                        "error" => "",
                        "success" => false,
                        "data" => ""
                    ]);
            }
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error =>" . $e,
                    "error" => "algo salio mal",
                    "success" => false,
                    "data" => ""
                ]);
        }
    }

    function disminuir_material(Request $req)
    {
        try {
            $cantidad = $req->all()["disminuir"];

            $created = control_inventario::create(["Inx_Id" => $req->all()["inx_id"], "Cinx_Cantidad" => $cantidad, "Cinx_Ingreso" => "DI"]);

            if ($created) {
                return response()
                    ->json([
                        "message" => "se registro correctamente",
                        "error" => "",
                        "success" => true,
                        "data" => ""
                    ]);
            } else {
                return response()
                    ->json([
                        "message" => "error al registrar",
                        "error" => true,
                        "success" => false,
                        "data" => ""
                    ]);
            }
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error al registrar",
                    "error" => true,
                    "success" => false,
                    "data" => ""
                ]);
        }
    }

    function aumentar_material(Request $req)
    {
        try {
            $cantidad = $req->all()["aumentar"];

            $created = control_inventario::create(["Inx_Id" => $req->all()["inx_id"], "Cinx_Cantidad" => $cantidad, "Cinx_Ingreso" => "AU"]);

            if ($created) {
                return response()
                    ->json([
                        "message" => "se registro correctamente",
                        "error" => "",
                        "success" => true,
                        "data" => ""
                    ]);
            } else {
                return response()
                    ->json([
                        "message" => "error al registrar",
                        "error" => true,
                        "success" => false,
                        "data" => ""
                    ]);
            }
        } catch (Throwable $e) {
            return response()
                ->json([
                    "message" => "error al registrar",
                    "error" => true,
                    "success" => false,
                    "data" => ""
                ]);
        }
    }
}
