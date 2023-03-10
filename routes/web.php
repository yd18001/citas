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

/*--------------------Rutas de controladores--------------*/
//Rutas Usuarios
Route::middleware(['can:usuarios.index'])->group(function () {
    // Rutas que requieren el permiso "usuarios.index"
    Route::resource('usuarios', 'App\Http\Controllers\UsersController');
    Route::resource('especialidades', 'App\Http\Controllers\EspecialidadController');
    Route::resource('medicos', 'App\Http\Controllers\MedicoController');
    Route::resource('exams', 'App\Http\Controllers\ExamCOntroller');
});

Route::middleware(['can:citas.index'])->group(function () {
    //Rutas Paciente
    Route::resource('pacientes', 'App\Http\Controllers\PacienteController');

    //Rutas Citas
    Route::resource('citas', 'App\Http\Controllers\CitaController');
});

//Rutas Paciente
Route::resource('pacientes', 'App\Http\Controllers\PacienteController');

//Rutas Citas
Route::resource('citas', 'App\Http\Controllers\CitaController');

//Ruta Dashboard
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::resource('dashboard', DashboardController::class);
