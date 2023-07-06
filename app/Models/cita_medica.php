<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cita_medica extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_area_medica',
        'fecha_hora_atencion',
        'id_paciente',
        'id_doctor'
    ];
}
