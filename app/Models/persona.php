<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class persona extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombres',
        'apellidos',
        'cedula',
        'telefono',
        'fecha_nacimiento',
        'id_user'
    ];
}
