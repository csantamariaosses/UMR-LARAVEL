<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\ProcedimientoLaboratorioController;
use App\Http\Controllers\ProcedimientoPabellonController;
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
    return view('login');
});

//Route::post("acceso", "UsuariosController@acceso");
Route::get("home",[UsuariosController::class, "home"]);
Route::post("acceso",[UsuariosController::class, "acceso"]);
Route::get("salir",[UsuariosController::class, "logout"]);


// MEDICOS
Route::resource('medicos','App\Http\Controllers\MedicosController');

// PROCEDIMIENTOS LABORATORIO
Route::resource('procedimientoLaboratorio','App\Http\Controllers\ProcedimientoLaboratorioController');

// PROCEDIMIENTOS PABELLON
Route::resource('procedPab','App\Http\Controllers\ProcedPabController');

// PACIENTES
Route::resource('pacientes','App\Http\Controllers\PacienteController');
//Route::get('pacientes/nuevoCiclo','App\Http\Controllers\PacienteController');

// CONYUGES
Route::resource('conyuges','App\Http\Controllers\ConyugeController');

// CONYUGES
Route::resource('estadociclos','App\Http\Controllers\EstadocicloController');

// CICLOS
Route::resource('ciclos','App\Http\Controllers\CicloController');

// CICLOS2
Route::resource('ciclo2s','App\Http\Controllers\Ciclo2Controller');

Route::get('ciclosListado','App\Http\Controllers\Ciclo2Controller@listadoCiclos');

Route::get('ciclosTest','App\Http\Controllers\CicloController@test');
Route::post('ciclosTest','App\Http\Controllers\CicloController@guardar');


// CICLOS PACIENTES
Route::resource('cicloPacientes','App\Http\Controllers\CicloPacienteController');