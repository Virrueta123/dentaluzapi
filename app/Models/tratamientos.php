<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tratamientos extends Model
{
    use HasFactory;
    protected $table = "tratamientos";
    protected $primaryKey = 'Tx_Id';
    public $timestamps = false;
    protected $guarded = [ ];

    public function doctor(){
        return $this->belongsTo(User::class,"Tx_Doc_Id");
    }

    public function usuario(){
        return $this->belongsTo(User::class,"Tx_User_Id");
    }

    public function tipocuenta(){
        return $this->belongsTo(tipocuentas::class,"Tx_Cuenta_Id");
    }

}
