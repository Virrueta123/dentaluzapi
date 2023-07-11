<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class unidad_didactica extends Model
{
    use HasFactory;
    protected $primaryKey = 'Unix_Id';
    protected $guarded = [];
    protected $table = 'unidad_didactica';
    public $timestamps = false;
    protected $hidden = ['Unix_Id','Perx_Id'];
}
