<?php

namespace App\Http\Controllers;

use App\Models\persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public static function inicialCreate($user, $user2){
        persona::create([
            'nombres' => $user['name'],
            'apellidos' => $user2,

            'id_user' => $user['id'],
            
        ]);
    }
}
