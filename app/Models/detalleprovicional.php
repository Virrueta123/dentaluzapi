<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class detalleprovicional extends Model
{
    use HasFactory,SoftDeletes;
   
    protected $primaryKey = 'Prepd_Id';
    protected $guarded = [];
    protected $table = 'detallepreprovicional';
    public $timestamps = false;

    public function preciotx(){
        return $this->belongsTo(preciostx::class,"Ptxd_Id");
    }
}
