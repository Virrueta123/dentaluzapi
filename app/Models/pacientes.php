<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pacientes extends Model
{
    use HasFactory;
    protected $table = "pacientes";
    protected $primaryKey = 'Px_Id';
    public $timestamps = false;
    protected $guarded = [];
    
    public function doctor(){
        return $this->belongsTo(User::class,"Px_IdDoctor");
    }
}
