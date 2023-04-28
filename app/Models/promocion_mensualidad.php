<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promocion_mensualidad extends Model
{
    use HasFactory;
    protected $table = "promocion_mensualidad";
    protected $primaryKey = 'Prm_Id';
    public $timestamps = true;
    protected $guarded = [ ];
}
