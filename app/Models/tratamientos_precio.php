<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tratamientos_precio extends Model
{
    use HasFactory;

    protected $table = "preciotx";
    protected $primaryKey = 'Ptxd_Id';
    public $timestamps = false;
    protected $guarded = [ ];
}
