<?php

namespace App\Http\Controllers;

use App\Models\roles;
use App\Models\user_roles;
use Illuminate\Http\Request;

class UserRolesController extends Controller
{
    public static function create($user){
        $roles = roles::find(2);
        user_roles::create([
            'id_user' => $user['id'],
            'id_rol' => $roles['id'],
        ]);
    }
}
