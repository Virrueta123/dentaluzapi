<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preprovicional_model extends Model
{
    use HasFactory;
    protected $primaryKey = 'Prep_Id';
    protected $guarded = [];
    protected $table = 'preprovicional';
    public $timestamps = false;
}
