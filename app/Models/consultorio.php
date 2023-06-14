<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultorio extends Model
{
    use HasFactory; 
    protected $primaryKey = 'Cox_Id';
    protected $guarded = [];
    protected $table = 'consultorios';
}
