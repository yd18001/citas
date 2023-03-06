<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Medico;
use App\Models\Exam;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas = Cita::with(['medico', 'exam'])->get();
        return view('citas.index')->with('citas', $citas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $medicos = Medico::where('estadoMedico', true)->get();
        $exams = Exam::where('estadoExamen', true)->get();
        return view('citas.create', compact('medicos', 'exams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fechaCita' => 'required',
        ]);

        // Obtener el tipo seleccionado
        $tipo = $request->input('tipo');

        if ($tipo == 'medico') {
            // Obtener el médico seleccionado
            $medico_id = $request->input('medico_id');
            $medico = Medico::find($request->medico_id);

            // Verificar si el número de citas para este médico en este día ya ha alcanzado el límite
            $numCitasMedico = $medico->citas()->where('fechaCita', $request->fechaCita)->where('estadoCita', 'Agendada')->count();

            if ($numCitasMedico >= $medico->limiteCitas) {
                return redirect()->back()->with('error', 'El médico ya ha alcanzado el límite de citas para este día.');
            }

            // Crear la cita con el médico
            $cita = new Cita();
            $cita->nombreCompleto = $request->input('nombreCompleto');
            $cita->numeroTelefono = $request->input('numeroTelefono');
            $cita->fechaCita = $request->input('fechaCita');
            $cita->horaCita = $request->input('horaCita');
            $cita->medico_id = $medico_id;
            $cita->estadoCita = 'Agendada';
            $cita->save();
        } else {

            // Obtener el examen seleccionado
            $exam_id = $request->input('exam_id');
            $examen = Exam::find($request->exam_id);

            // Verificar si el número de citas para este examen en este día ya ha alcanzado el límite
            $numCitasExamen = $examen->citas()->where('fechaCita', $request->fechaCita)->where('estadoCita', 'Agendada')->count();

            if ($numCitasExamen >= $examen->limiteCitas) {
                return redirect()->back()->with('error', 'El examen ya ha alcanzado el límite de citas para este día.');
            }

            // Crear la cita con el examen
            $cita = new Cita();
            $cita->nombreCompleto = $request->input('nombreCompleto');
            $cita->numeroTelefono = $request->input('numeroTelefono');
            $cita->fechaCita = $request->input('fechaCita');
            $cita->horaCita = $request->input('horaCita');
            $cita->exam_id = $exam_id;
            $cita->estadoCita = 'Agendada';
            $cita->save();
        }

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cita = Cita::find($id);
        return view('citas.show', compact('cita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cita = Cita::find($id);
        $medicos = Medico::where('estadoMedico', true)->get();
        $exams = Exam::where('estadoExamen', true)->get();
        return view('citas.edit', compact('cita', 'medicos', 'exams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);

        // Actualizar el estado de la cita
        $cita->fechaCita = $request->input('fechaCita');
        $cita->estadoCita = $request->input('estadoCita');
        $cita->save();

        return redirect('/citas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cita = Cita::find($id);
        $cita->delete();
        return redirect('/citas');
    }
}
