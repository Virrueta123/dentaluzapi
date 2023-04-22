<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class citas extends Model
{
    use HasFactory;
    protected $table = "citas";
    protected $primaryKey = 'Cx_Id';
    public $timestamps = true;
    protected $guarded = [ ];

    public function pacientes(){
        return $this->belongsTo(pacientes::class,"Cx_Id_px");
    }

    public function doctores(){
        return $this->belongsTo(User::class,"Cx_Id_doctor");
    }
}