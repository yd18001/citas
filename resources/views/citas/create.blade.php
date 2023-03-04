@extends('adminlte::page')
@section('title', 'Agendar | Cita')
@section('content')

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var selectTipo = document.getElementById('tipo');
    var selectMedico = document.getElementById('select-medico');
    var selectExamen = document.getElementById('select-examen');

    selectTipo.addEventListener('change', function() {
        if (selectTipo.value == 'medico') {
            selectMedico.style.display = 'block';
            selectExamen.style.display = 'none';
        } else if (selectTipo.value == 'examen') {
            selectMedico.style.display = 'none';
            selectExamen.style.display = 'block';
        } else {
            selectMedico.style.display = 'none';
            selectExamen.style.display = 'none';
        }
    });
});
</script>

<!-- Card -->
<div class="d-flex">
    <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
        <h5 class="card-header text-center text-white bg-dark">Agendar Cita</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('citas.store') }}">
                @csrf

                <div class="form-group">
                    <label for="nombreCompleto">Nombre completo del paciente:</label>
                    <input type="text" class="form-control" id="nombreCompleto" name="nombreCompleto" required>
                </div>
                
                <div class="form-group">
                    <label for="numeroTelefono">Telefono del paciente:</label>
                    <input type="text" class="form-control" id="numeroTelefono" name="numeroTelefono" required>
                </div>                

                <div class="form-group">
                    <label for="fechaCita">Fecha de la cita:</label>
                    <input type="date" class="form-control" id="fechaCita" name="fechaCita" required>
                </div>

                <div class="form-group">
                    <label for="horaCita">Hora de la cita:</label>
                    <input type="time" class="form-control" id="horaCita" name="horaCita">
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <select class="form-control" id="tipo" name="tipo" required>
                        <option value="">Seleccione un tipo de Cita</option>
                        <option value="medico">Médico</option>
                        <option value="examen">Examen</option>
                    </select>
                </div>

                <div id="select-medico" style="display:none;">
                    <label for="medico_id">Médico</label>
                    <select class="form-control" id="medico_id" name="medico_id">
                        <option value="">Seleccione un medico</option>
                        @foreach($medicos as $medico)
                        <option value="{{ $medico->id }}">{{ $medico->nombreMedico }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="select-examen" style="display:none;">
                    <label for="exam_id">Examen:</label>
                    <select class="form-control" id="exam_id" name="exam_id">
                        <option value="">Seleccione un examen</option>
                        @foreach ($exams as $exam)
                        <option value="{{ $exam->id }}">{{ $exam->nombreExamen }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div id="error-message" style="display: none;" class="text-center">
                    Error al crear la cita. Puede que el cupo ya este lleno
                </div>
                    @if (session('error'))
                    <script>
                        document.getElementById('error-message').style.display = 'block';
                    </script>
                    @endif
                
                <!-- Botones -->
                <div class="text-center">
                    <a href="/dashboard" class="btn btn-secondary btn-margin">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-margin">Agendar Cita</button>
                </div>
                <!-- Botones -->
                        
            </form>
        </div>
    </div>
</div>
<!-- Card -->

@endsection