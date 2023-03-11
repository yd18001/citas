<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Especialidad;
use App\Models\Medico;
use App\Models\Exam;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
        $citas = Cita::all();
        $medicos = Medico::all();
        $exams = Exam::all();
        $especialidades = Especialidad::all();
        $citas = Cita::query();

        $citas = $citas->get();

        $eventos = $citas->map(function ($cita) {
            $evento = [
                'title' => $cita->nombreCompleto . ' (' . $cita->numeroTelefono . ')',
                'start' => $cita->fechaCita,
            ];
            return $evento;
        });

        $eventos_json = $eventos->toJson();

        $citasDelDia = Cita::with(['medico', 'exam'])
                ->whereDate('fechaCita', now()->toDateString())
                ->paginate(10);

        return view('dashboard', compact(
            'citas',
            'citasDelDia',
            'especialidades',
            'eventos',
            'medicos',
            'exams',
            'eventos_json'
        ));
    }
}
