<?php

use App\Http\Controllers\authentications;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RolesController;
use App\Models\area_medica;
use App\Models\cita_medica;
use App\Models\doctor_area_medica;
use App\Models\User;
use App\Models\form1;
use App\Models\form2;
use App\Models\form3;

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
    $user = Auth::user()->id;
    $form1 = DB::select("select * from form1 where id_user = $user");
    if (($idRolUser[0]->id_rol) == 2) {
        return view('doctores.platform_doctor', ['form1' => $form1]);
    } if (($idRolUser[0]->id_rol) == 3) {
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
    } else{
        return view('doctores.platform_doctor');

    }
})
->middleware(["auth", "verified"])
->name('home');




Route::get('/get_doctors_departament/{id}', function (Request $request, $id) {
    if ($request->ajax()) {
        $doctor_area = DB::table('doctor_area_medicas')
        ->leftJoin('users', 'users.id', '=', 'doctor_area_medicas.id_doctor')
        ->select('users.id as id','users.name as name')
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
    // $user_doctor = doctor_area_medica::all('id_doctor');
    $user_doctor = DB::select("select id_doctor from doctor_area_medica");
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

Route::get('/view_cita_medica', function(){
    $paciente = Auth::id();

    $cita_medica = cita_medica::all();
    $citas_medicas = DB::table('cita_medicas')
        ->Join('users', 'users.id', '=', 'cita_medicas.id_doctor')
        ->Join('area_medicas','area_medicas.id', '=', 'cita_medicas.id_area_medica')
        ->where('cita_medicas.id_paciente', $paciente)
        ->select('cita_medicas.fecha_hora_atencion','users.name as name', 'area_medicas.nombre_area')
        ->get();
    return $citas_medicas;
});

Route::post('/submit_cita_medica', function(){
    $area_medi = request('area');
    $doctor = request('doctor_area_medicas');
    $paciente = Auth::id();
    $hora_atencion = request('checkbox');
    cita_medica::create([
        'fecha_hora_atencion' => $hora_atencion,
        'id_area_medica' => $area_medi,
        'id_paciente' => $paciente,
        'id_doctor' => $doctor,
    ]);

    return redirect('home');
})
->name('submit_cita_medica');

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
    DB::insert("insert into doctor_area_medica (id_doctor, id_area_medica) values (?, ?) ",[$id_doctor, request('id_area_medica')]);

    $role_edit = $user->update([
        'id_rol' => 2,
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

//Form 1
Route::get('/form1', function () {
    $user = Auth::user()->id;
    $form1 = DB::select("select * from form1 where id_user = $user");
    if ($form1) {
        return redirect('form2');
    } else {
        return view('forms.form1');
    }
    // return $user;
})->middleware('auth')->name('form1');

Route::post('/post_form1', function () {
    $user = Auth::user()->id;
    $desc = request('descripcion');
    // $form1 = DB::select("select * from form1 where id_user = $user");

    // if ($form1) {
    //     return redirect('form2');
    // } else {
    DB::insert('insert into form1 (descripcion, id_user) values (?, ?)', [$desc, $user]);
    return redirect('form2');
    // }
    // form1::create([
    //     'descripcion' => $desc,
    //     'id_user' => $user,
    // ]);
})->middleware('auth')->name('form1.store');

//Form 2
Route::get('/form2', function () {
    $user = Auth::user()->id;
    $form1 = DB::select("select * from form1 where id_user = $user");
    $form2 = DB::select("select * from form2 where id_user = $user");

    if ($form1) {
        if ($form2) {
            return redirect('form3');
        } else {
            return view('forms.form2');
        }
    } else {
        return redirect('form1');
    }

})->middleware('auth')->name('form2');

Route::post('/post_form2', function () {
    $user = Auth::user()->id;
    $desc = request('descripcion');
    // $form2 = DB::select("select * from form2 where id_user = $user");

    // if ($form2) {
    //     return redirect('form3');
    // } else {
    DB::insert('insert into form2 (descripcion, id_user) values (?, ?)', [$desc, $user]);
    return redirect('form3');
    // }
})->middleware('auth')->name('form2.store');

//Form 3
Route::get('/form3', function () {
    $user = Auth::user()->id;
    $form2 = DB::select("select * from form2 where id_user = $user");
    $form3 = DB::select("select * from form3 where id_user = $user");

    // if ($form2) {
    //     return view('forms.form3');

    // } else {
    //     return redirect('form2');
    // }
    if ($form2) {
        if ($form3) {
            return redirect('finished_forms');
        } else {
            return view('forms.form3');
        }
    } else {
        return redirect('form2');
    }
    // $form3 = form3::all()->where('id_user', $user);
    // return view('forms.form3');
    // return $user;
})->middleware('auth')->name('form3');

Route::post('/post_form3', function () {
    $user = Auth::user()->id;
    $desc = request('descripcion');
    // $form3 = DB::select("select * from form3 where id_user = $user");

    // if ($form3) {
    //     return redirect('form3');
    // } else {
    DB::insert('insert into form3 (descripcion, id_user) values (?, ?)', [$desc, $user]);
    return redirect('finished_forms');
    // }
})->name('form3.store');

//Finish forms
Route::get('/finished_forms', function(){
    return view('finished');
})->name('finished_forms');

//Edit form1
Route::get('/view_form1', function(){
    $user = Auth::user()->id;
    $form1 = DB::select("select * from form1 where id_user = $user");
    return view('forms.form1_edit', ['form1' => $form1]);
})->name('form1.viewOne');

Route::post('/edited_form1', function($id){

    return view('forms.form1_edit');
})->name('form1.edit');

//Edit form2
Route::get('/view_form2', function(){
    $user = Auth::user()->id;
    $form2 = DB::select("select * from form2 where id_user = $user");
    return view('forms.form2_edit', ['form2' => $form2]);
})->name('form2.viewOne');

Route::post('/edited_form2', function($id){

    return view('forms.form1_edit');
})->name('form2.edit');
//Edit form3
Route::get('/view_form3', function(){
    $user = Auth::user()->id;
    $form3 = DB::select("select * from form3 where id_user = $user");
    return view('forms.form3_edit', ['form3' => $form3]);
})->name('form3.viewOne');
Route::post('/edited_form3', function($id){
    // return view('forms.form1_edit');
})->name('form3.edit');

Route::post('/createRole', [RolesController::class, 'create'])->middleware(['auth'])->name('createRole');

require __DIR__ . '/auth.php';
