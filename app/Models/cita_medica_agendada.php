<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cita_medica_agendada extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_cita',
        'descripcion',
    ];
}
