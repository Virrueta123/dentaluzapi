<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumnos extends Model
{
    use HasFactory;
    protected $table = "alumnos";
    protected $primaryKey = 'Al_Id'; 
    protected $guarded = [ ];
}
