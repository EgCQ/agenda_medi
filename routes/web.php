<?php

use App\Http\Controllers\authentications;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RolesController;
use App\Models\area_medica;
use App\Models\doctor_area_medica;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\user_roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('/inicial', function () {
    $roles = user_roles::all();
    if (count($roles) < 1) {
        RolesController::inicialCreate();
    }
    return redirect('/');
});

Route::get('/home', function (Request $request) {
    $idRolUser = user_roles::where('id_user', Auth::id())->get();

    if (($idRolUser[0]->id_rol) == 1) {
        return view('doctores.platform_doctor');
    } else {
        $departamentos = area_medica::all();
        // $departamentos = DB::table('doctor_area_medicas')
        // ->select('id_doctor as doctor, id_area_medica as area')
        // ->get();
        // $departamentos = DB::table('doctor_area_medicas')
        //                 ->select('users.name as doctor','area_medicas.nombre_area as area')
        //                 ->join('area_medicas', 'doctor_area_medicas.id_area_medica', '=', 'area_medicas.id')
        //                 ->join('users', 'users.id', '=', 'doctor_area_medicas.id_doctor')
        //                 ->get();
        return view('pacientes.platform_paciente', ['departamentos' => $departamentos]);
    }
})
->middleware("auth")
->name('home');

Route::get('/get_doctors_departament/{id}', function (Request $request, $id) {
    if ($request->ajax()) {
        $doctor_area = DB::table('doctor_area_medicas')
        ->leftJoin('users', 'users.id', '=', 'doctor_area_medicas.id_doctor')
        ->select('users.name as name')
        ->where('doctor_area_medicas.id_area_medica', $id)
        ->get();
        return response()->json($doctor_area);
    }
});

Route::get('/agregar_departamento', function(){
    $departamentos = area_medica::all();
    return view('doctores.agregar_departamento', ['departamentos' => $departamentos]);
})
->name('agregar_departamento')
->middleware('isAdmin');

Route::get('/area_medica/{id}', function($id){
    $area_medica =  area_medica::find($id);
    // return view('departamento.agregar_doctor_area', ['doctores_area_medica' => $doctores_area_medica]);
    return view('departamento.agregar_doctor_area', ['area_medica' => $area_medica]);

})
->name('area_medica.view')
->middleware('isAdmin');

Route::get('/usuario_doctor', function(){
    $user_doctor = doctor_area_medica::all('id_doctor');
    $users = user::whereNotIn('id', $user_doctor)->get();
    return $users;

})->middleware('auth')->name('usuario_doctor.view');

Route::post('/departamento_agregado', function(){

    area_medica::create([
        'nombre_area' => request('nombre_area'),
        'descripcion' => request('descripcion'),
    ]);

    return redirect('area_medica');
})
->name('departamento_agregado')
->middleware('isAdmin');


Route::get('/doctor_area/{id}', function($id){
    $doctor_area = DB::table('doctor_area_medicas')
                    ->leftJoin('users', 'users.id', '=', 'doctor_area_medicas.id_doctor')
                    ->select('users.name as name', 'doctor_area_medicas.*')
                    ->where('doctor_area_medicas.id_area_medica', $id)
                    ->get();
    return $doctor_area;

})->middleware('auth')->name('doctor_area.view_doctor');


Route::post('/doctor_area_agregado', function(Request $request){
    $id_doctor = $request->id_doctor;
    $user = user_roles::where('id_user', $id_doctor)->first();
    $id_area = request('id_area_medica');
    doctor_area_medica::create([
        'id_doctor' => $id_doctor,
        'id_area_medica' => request('id_area_medica'),
    ]);
    $role_edit = $user->update([
        'id_rol' => 1,
    ]);
    return redirect()->route('area_medica.view', [$id_area]);
})->middleware('auth')->name('doctor_area.add');

Route::delete('/doctor_area_eliminado/{id}', function($id){
    $doctor_delete = doctor_area_medica::find($id);
    $id_doctor = $doctor_delete->id_doctor;
    $user_role = user_roles::where('id_user', $id_doctor);
    $doctor_delete->delete();
    $remove_rol = $user_role->update([
        'id_rol' => 2,
    ]);
    $id_area = request('id_area_medica');

})->middleware('isAdmin')->name('doctor_area.deleted');


Route::post('/createRole', [RolesController::class, 'create'])->middleware(['auth'])->name('createRole');

require __DIR__ . '/auth.php';
