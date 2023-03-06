<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
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
        $exams = Exam::all();
        return view('exams.index')->with('exams', $exams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exam = new Exam();
        $exam->nombreExamen = $request->get('nombreExamen');
        $exam->clinica = $request->get('clinica');
        $exam->limiteCitas = $request->get('limiteCitas');
        $exam->estadoExamen = $request->get('estadoExamen') == 1 ? true : false;
        $exam->save();
        return redirect('/exams');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::find($id);
        return view('exams.edit')->with('exam', $exam);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $exam = Exam::find($id);
        $exam->nombreExamen = $request->get('nombreExamen');
        $exam->clinica = $request->get('clinica');
        $exam->limiteCitas = $request->get('limiteCitas');
        $exam->estadoExamen = $request->get('estadoExamen');
        $exam->save();
        return redirect('/exams');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::find($id);
        $exam->delete();
        return redirect('/exams');
    }
}
