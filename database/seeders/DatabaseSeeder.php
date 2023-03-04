<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use App\Models\Exam;
use App\Models\Medico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::create([
            'name' => 'Administrador',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
        $admin->save();

        $test = User::create([
            'name' => 'Archivo Caja 1',
            'username' => 'archivo1',
            'password' => Hash::make('archivo'),
            'role' => 'recepcion',
        ]);
        $test->save();

        $especialidad = Especialidad::create([
        'nombreEspecialidad' => 'Psicología',
        'clinica' => 'Antiguo Cuscatlán',
        'estadoEspecialidad' => true,
        ]);
        $especialidad->save();

        $especialidad = Especialidad::create([
            'nombreEspecialidad' => 'Neurología',
            'clinica' => 'Antiguo Cuscatlán',
            'estadoEspecialidad' => true,
        ]);
        $especialidad->save();

        $medico = Medico::create([
            'nombreMedico' => 'Lic. Yoysi Nuñez',
            'limiteCitas' => 1,
            'estadoMedico' => true,
            'id_especialidad' => 1,
        ]);
        $medico->save();

        $examen = Exam::create([
            'nombreExamen' => 'Ecocardiograma',
            'clinica' => 'Antiguo Cuscatlán',
            'limiteCitas' => 5,
            'estadoExamen' => true,
        ]);
        $examen->save();

        $examen = Exam::create([
            'nombreExamen' => 'MAPA',
            'clinica' => 'Antiguo Cuscatlán',
            'limiteCitas' => 3,
            'estadoExamen' => true,
        ]);
        $examen->save();

        $examen = Exam::create([
            'nombreExamen' => 'Holter',
            'clinica' => 'Antiguo Cuscatlán',
            'limiteCitas' => 4,
            'estadoExamen' => true,
        ]);
        $examen->save();
    }
}
