<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personas extends Model
{
    use HasFactory;
    protected $primaryKey = 'Perx_Id';  
    protected $table = 'persona';
    public $timestamps = false;
    protected $hidden = ['Perx_Id'];

    public function unidad_didactica(){
        return $this->hasMany(unidad_didactica::class,"Perx_Id");
    }
}
