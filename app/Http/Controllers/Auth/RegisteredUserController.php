<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UserRolesController;
use App\Http\Controllers\UsersRolesController;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // $valide = Validator::make(request()->all(),
        // [   'name' => 'required',
        //     'lastname' =>'required',
        //     'email' => 'required|email|unique:users,email,email',
        //     'password' => 'required|confirmed',
        // ]);
        // if ($valide->fails()) {
        //     return redirect()->back()->withInput();
        // }
        request()->validate([
            'name' => 'required',
            'lastname' =>'required',
            'email' => 'required|email|unique:users,email,email',
            'password' => 'required|confirmed',
        ]);
        $email = request('email');
        $query = DB::select("select * from users where email = '$email'");
        // $user_query = $query[0]->email;
        $count_user = count($query);

        // if ($count_user >= 1){
        //     return redirect()->back()->with("error", "Este usuario ya esta registrado");
        // } else {
            $user = User::create([
                'name' => request('name'),
                'email' => $email,
                'password' => request('password'),
            ]);
            $user2 = request('lastname');
            auth()->login($user);

            PersonaController::inicialCreate($user, $user2);

            UserRolesController::create($user);

            return redirect(RouteServiceProvider::HOME)->with("success", "Registro exitoso");
            // return "Registro exitoso";
        // }



    }
}
