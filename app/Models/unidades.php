<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unidades extends Model
{
    use HasFactory;
    protected $primaryKey = 'Unx_Id';
    protected $guarded = [];
    protected $table = 'unidades';
    public $timestamps = false;
    
}
