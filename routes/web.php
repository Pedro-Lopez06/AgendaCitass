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

Route::middleware(['auth', 'admin'])->group(function () {
   //Rutas de Especialidades
Route::get('/especialidades', [App\Http\Controllers\admin\SpecialityController::class, 'index']);
Route::get('/especialidades/create', [App\Http\Controllers\admin\SpecialityController::class, 'create']);
Route::get('/especialidades/{speciality}/edit', [App\Http\Controllers\admin\SpecialityController::class, 'edit']);
Route::post('/especialidades', [App\Http\Controllers\admin\SpecialityController::class, 'sendData']);

Route::put('/especialidades/{speciality}', [App\Http\Controllers\admin\SpecialityController::class, 'update']);
Route::delete('/especialidades/{speciality}', [App\Http\Controllers\admin\SpecialityController::class, 'destroy']);

//Rutas de Medicos
Route::resource('medicos','App\Http\Controllers\admin\DoctorController');

// Rutas Pacientes
Route::resource('pacientes','App\Http\Controllers\admin\PatientController');
});

Route::middleware(['auth', 'doctor'])->group(function () {
    Route::get('/horario', [App\Http\Controllers\doctor\HorarioController::class, 'edit']);
    Route::post('/horario', [App\Http\Controllers\doctor\HorarioController::class, 'store']);

});

Route::get('/reservarcita/create', [App\Http\Controllers\AppointmentController::class, 'create']);
Route::post('/miscitas', [App\Http\Controllers\AppointmentController::class, 'store']);
