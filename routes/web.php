<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Rutas de Especialidades
Route::get('/especialidades', [App\Http\Controllers\SpecialityController::class, 'index']);
Route::get('/especialidades/create', [App\Http\Controllers\SpecialityController::class, 'create']);
Route::get('/especialidades/{speciality}/edit', [App\Http\Controllers\SpecialityController::class, 'edit']);
Route::post('/especialidades', [App\Http\Controllers\SpecialityController::class, 'sendData']);

Route::put('/especialidades/{speciality}', [App\Http\Controllers\SpecialityController::class, 'update']);
Route::delete('/especialidades/{speciality}', [App\Http\Controllers\SpecialityController::class, 'destroy']);

//Rutas de Medicos
Route::resource('medicos','App\Http\Controllers\DoctorController');

// Rutas Pacientes
Route::resource('pacientes','App\Http\Controllers\PatientController');
