<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipocuentas extends Model
{
    use HasFactory;
    protected $table = "tipotarjetas";
    protected $primaryKey = 'Tt_Id';
    public $timestamps = false;
    protected $guarded = [ ];
}
