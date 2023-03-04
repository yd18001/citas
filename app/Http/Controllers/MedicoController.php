<?php

namespace App\Http\Controllers;

use App\Models\Especialidad;
use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role == 'recepcion' || auth()->user()->role == 'user') {
                abort(403);
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos = Medico::all();
        return view('medicos.index')->with('medicos', $medicos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidades = Especialidad::all();
        return view('medicos.create')->with('Especialidad', $especialidades);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $medicos = new Medico();
        $medicos->id = $request->get('id');
        $medicos->nombreMedico = $request->get('nombreMedico');
        $medicos->limiteCitas = $request->get('limiteCitas');
        $medicos->estadoMedico = $request->get('estadoMedico') == 1 ? true : false;
        $medicos->id_especialidad = $request->get('id_especialidad');

        $medicos->save();

        return redirect('/medicos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function show(Medico $medico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medico = Medico::find($id);
        $especialidades = Especialidad::all(); 
        return view('medicos.edit')->with('medico', $medico)->with('especialidades', $especialidades);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $medico = Medico::find($id);

        $medico->nombreMedico = $request->get('nombreMedico');
        $medico->limiteCitas = $request->get('limiteCitas');
        $medico->estadoMedico = $request->get('estadoMedico');
        $medico->id_especialidad = $request->get('especialidad');

        $medico->save();
        return redirect('/medicos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medico  $medico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medico = Medico::find($id);
        $medico->delete();
        return redirect('/medicos');
    }
}
