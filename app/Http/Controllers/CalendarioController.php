<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Medico;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index(Request $request)
    {
        $medicos = Medico::all();
        $exams = Exam::all();

        $filtro = $request->input('filtro');  //obtener el valor del filtro del request

        $citas = Cita::query();

        $selectedMedico = null;
        $selectedExam = null;

        if ($filtro) {
            list($tipo, $id) = explode('_', $filtro);
            switch ($tipo) {
                case 'medico':
                    $citas->where('medico_id', $id);
                    $selectedMedico = Medico::find($id);
                    break;
                case 'exam':
                    $citas->where('exam_id', $id);
                    $selectedExam = Exam::find($id);
                    break;
            }
        }

        $citas = $citas->get();

        $eventos = $citas->map(function ($cita) {
            $evento = [
                'title' => $cita->nombreCompleto . ' (' . $cita->numeroTelefono . ')',
                'start' => $cita->fechaCita,
            ];
            if ($cita->medico && $this->citaExcedida($cita, $cita->medico)) {
                $evento += $this->citaExcedidaColor($cita, $cita->medico);
            } elseif ($cita->exam && $this->citaExcedida($cita, $cita->exam)) {
                $evento += $this->citaExcedidaColor($cita, $cita->exam);
            }
            return $evento;
        });

        $eventos_json = $eventos->toJson();

        return view('calendario', compact(
            'eventos',
            'medicos',
            'exams',
            'selectedMedico',
            'selectedExam',
            'filtro',
            'eventos_json'
        ));
    }

    private function citaExcedida(Cita $cita, $entity): bool
    {
        //Funcion para validar el limite de los cupos por especialidad
        return $entity->citas()
            ->where('fechaCita', $cita->fechaCita)
            ->where('estadoCita', 'Agendada')
            ->count() >= $entity->limiteCitas;
    }

    private function citaExcedidaColor(Cita $cita, $entity): array
    {
        return [
            'color' => 'red', // Se para indicar que la cita que ha superado el límite
            'tooltip' => "Este {$entity->tipo} ha alcanzado el límite de citas para esta fecha", // Mensaje al validar que no hay cupos disponibles
        ];
    }
}
