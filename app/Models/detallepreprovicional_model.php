<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detallepreprovicional_model extends Model
{
    use HasFactory;
    protected $primaryKey = 'Prepd_Id';
    protected $guarded = [];
    protected $table = 'detallepreprovicional';
    public $timestamps = false;
}
