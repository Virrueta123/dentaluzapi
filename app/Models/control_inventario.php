<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class control_inventario extends Model
{
    use HasFactory; 
    protected $primaryKey = 'Cinx_id';
    protected $guarded = [];
    protected $table = 'control_inventario';

    public function inventario(){
        return $this->belongsTo(inventario::class,"Inx_Id");
    }
}
