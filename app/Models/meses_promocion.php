<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meses_promocion extends Model
{
    use HasFactory;
    protected $table = "meses_promocion";
    protected $primaryKey = 'Msp_Id';
    public $timestamps = true;
    protected $guarded = [ ];
}
