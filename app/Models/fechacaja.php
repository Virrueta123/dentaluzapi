<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\helper_controller;


class fechacaja extends Model
{
    use HasFactory;
    protected $primaryKey = 'Fd_Id';
    protected $guarded = ["Fd_Id"];
    protected $table = 'cajadiaria';
    
    public function crear($monto=0,$Operacion){
        
        $helper = new helper_controller();
                
        $fechaActual = \Carbon\Carbon::now()->format("Y-m-d");
        
        $sql = DB::select("CALL `iscajadiario`('".$helper->fechaactual()."')")[0]->monto;
        
        if( $sql==55.55 ){
            $fechaanterior = DB::select("SELECT `aperturacaja`('".$helper->fechaactual()."', '".$helper->mesActual()."', '".$helper->anoActual()."') AS monto")[0]->monto;
             
            if($Operacion =="aperturacaja"){
                $this->create([
                    'Fd_Fecha' => $helper->fechaactual(),
                    'Fd_monto_apertura' => $monto,
                    "Fd_monto_cierre"=> $monto
                ]); 
            }else{
                $this->create([
                    'Fd_Fecha' => $helper->fechaactual(),
                    'Fd_monto_apertura' => $fechaanterior,
                ]); 
            }
            switch ($Operacion) {
                case 'egress':
                    $updated = $this->where('Fd_Fecha',"".$helper->fechaactual()."")->first();  
                    $updated = $this->where('Fd_Fecha',"".$helper->fechaactual()."")->update(["Fd_monto_cierre"=>$updated->Fd_monto_apertura - $monto]);
                    break;
                
                case 'ingreso':
                    $updated = $this->where('Fd_Fecha',"".$helper->fechaactual()."")->first();
                    $updated = $this->where('Fd_Fecha',"".$helper->fechaactual()."")->update(["Fd_monto_cierre"=>$updated->Fd_monto_apertura + $monto]);
                     
                    break;
                default:
                    break;
            }  
        } else{
            switch ($Operacion) {
                case 'egress':
                    $updated = $this->where('Fd_Fecha',"".$helper->fechaactual()."")->first();
                    $updated = $this->where('Fd_Fecha',"".$helper->fechaactual()."")->update(["Fd_monto_cierre"=>$updated->Fd_monto_cierre - $monto]);
                      
                    break;
                
                case 'ingreso':
                    $updated = $this->where('Fd_Fecha',"".$helper->fechaactual()."")->first();
                    $updated = $this->where('Fd_Fecha',"".$helper->fechaactual()."")->update(["Fd_monto_cierre"=>$updated->Fd_monto_cierre + $monto]); 
                     
                    break;
                default:
                    break;
            }  
      }
      }
}
