<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area_medica extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre_area',
        'descripcion',
    ];
}
