<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class egresos extends Model
{
    use HasFactory;
    protected $table = "egresos";
    protected $primaryKey = 'Eg_Id'; 
    public $timestamps = false;
    protected $guarded = [ ];
}
