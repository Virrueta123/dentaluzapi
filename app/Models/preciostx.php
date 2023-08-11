<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preciostx extends Model
{
    use HasFactory;
    protected $table="preciotx";
    protected $primaryKey = 'Ptxd_Id';
    protected $guarded = []; 
    public $timestamps = false;
}
