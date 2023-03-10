<?php

namespace Database\Seeders;

use App\Models\Especialidad;
use App\Models\Exam;
use App\Models\Medico;
use Illuminate\Database\Seeder;
use Database\Factories\EspecialidadFactory;
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
        //Llamo al seede de roler para poder asignar roles a los usuarios
        $this->call(RoleSeeder::class);

        User::create([
            'name' => 'Administrador',
            'username' => 'admin',
            'password' => Hash::make('Fundeso1977'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Developer',
            'username' => 'dev',
            'password' => Hash::make('dev1998'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'Archivo Caja 1',
            'username' => 'caja1',
            'password' => Hash::make('archivo'),
        ])->assignRole('Recepcionista');

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

        $especialidad = Especialidad::create([
            'nombreEspecialidad' => 'Reumatología',
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
