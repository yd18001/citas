<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Exceptions\UnauthorizedException;
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

/*Route::group(['middleware' => ['role:Admin']], function () {
   
});*/

/*--------------------Rutas de controladores--------------*/
 //Rutas Usuarios
 Route::middleware(['can:editar-usuarios'])->group(function () {
    // Rutas que requieren el permiso "editar-usuarios"
    Route::resource('usuarios', 'App\Http\Controllers\UsersController');
    
});


//Rutas Medicos
Route::resource('medicos', 'App\Http\Controllers\MedicoController');
Route::get('medicos/{id}/edit', 'MedicoController@edit')->name('medicos.edit');

//Rutas Especialidad
Route::resource('especialidades', 'App\Http\Controllers\EspecialidadController');
Route::get('especialidades/{id}/edit', 'EspecialidadController@edit')->name('especialidades.edit');

//Rutas Examenes
Route::resource('exams', 'App\Http\Controllers\ExamCOntroller');
Route::get('exams/{id}/edit', 'ExamController@edit')->name('exams.edit');

//Rutas Paciente
Route::resource('pacientes', 'App\Http\Controllers\PacienteController');
Route::get('pacientes/{id}/edit', 'PacienteController@edit')->name('pacientes.edit');

//Rutas Citas
Route::resource('citas', 'App\Http\Controllers\CitaController');
Route::get('citas/{id}/edit', 'CitaContrelle@edit')->name('citas.edit');

//Ruta Dashboard
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::resource('dashboard', DashboardController::class);
