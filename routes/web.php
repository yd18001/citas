<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use JeroenNoten\LaravelAdminLte\Http\Controllers\DarkModeController;

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
    return redirect('/login');
});

//Routas a las que puede acceder el usuario recepcion
Route::middleware('checkRoleRecepcion')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/citas', 'CitasController@index')->name('citas');
});

/*--------------------Rutas de controladores--------------*/

//Rutas Usuarios
Route::resource('usuarios', 'App\Http\Controllers\UsersController');
Route::get('usuarios/{id}/edit', 'UserController@edit')->name('usuarios.edit');

//Rutas Medicos
Route::resource('medicos', 'App\Http\Controllers\MedicoController');
Route::get('medicos/{id}/edit', 'MedicoController@edit')->name('medicos.edit');

//Rutas Especialidad
Route::resource('especialidades', 'App\Http\Controllers\EspecialidadController');
Route::get('especialidades\{id}/edit', 'EspecialidadController@edit')->name('especialidades.edit');

//Rutas Examenes
Route::resource('exams', 'App\Http\Controllers\ExamCOntroller');
Route::get('exams\{id}/edit', 'ExamController@edit')->name('exams.edit');

//Rutas Paciente
Route::resource('pacientes', 'App\Http\Controllers\PacienteController');
Route::get('pacientes\{id}/edit', 'PacienteController@edit')->name('pacientes.edit');

//Rutas Citas
Route::resource('citas', 'App\Http\Controllers\CitaController');
Route::get('citas\{id]/edit', 'CitaContrelle@edit')->name('citas.edit');

//Ruta Dashboard
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::resource('dashboard', DashboardController::class);
Route::get('/dashboard/update-calendar', 'DashboardController@updateCalendar')->name('dashboard.update-calendar');

Route::post('/darkmode/toggle', [DarkModeController::class, 'toggle'])
    ->name('darkmode.toggle');
