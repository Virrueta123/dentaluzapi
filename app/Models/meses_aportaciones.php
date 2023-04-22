<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class meses_aportaciones extends Model
{
    use HasFactory;
    protected $table = "meses_aportaciones";
    protected $primaryKey = 'Msa_Id';
    public $timestamps = true;
    protected $guarded = [ ];
}
