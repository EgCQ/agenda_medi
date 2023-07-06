<?php

namespace App\Http\Controllers;

use App\Models\roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    protected function create()
    {
        roles::create([
            'funcion' => request('funcion'),
        ]);
        return redirect('dashboard');
    }
    public static function inicialCreate()
    {
        roles::create([
            'funcion' => 'ADMIN',
        ]);
        roles::create([
            'funcion' => 'DOCTOR',
        ]);
        roles::create([
            'funcion' => 'PACIENTE',
        ]);
    }
}
