@extends('adminlte::page')
@section('title', 'Actualizar | Cita')
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
        <h5 class="card-header text-center text-white bg-dark">Editar Cita</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('citas.update', $cita->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombreCompleto">Paciente: </label>
                    <input type="text" class="form-control" id="paciente" name="paciente" value="{{$cita->nombreCompleto}} {{$cita->numeroTelefono}}" readonly>
                </div>                  

                <div class="form-group">
                    <label for="fechaCita">Fecha de la cita:</label>
                    <input type="date" class="form-control" id="fechaCita" name="fechaCita" value="{{ $cita->fechaCita }}">
                </div>

                <div class="form-group">
                    <label for="horaCita">Hora de la cita:</label>
                    <input type="time" class="form-control" id="horaCita" name="horaCita" value="{{ $cita->horaCita }}">
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo:</label>
                    <select class="form-control" id="tipo" name="tipo" readonly>
                        <option value="">Seleccione un tipo de Cita</option>
                        <option value="medico" {{ $cita->medico ? 'selected' : '' }}>Médico</option>
                        <option value="examen" {{ $cita->exam ? 'selected' : '' }}>Examen</option>
                    </select>
                </div>

                <div id="select-medico" style="{{ $cita->medico ? '' : 'display:none;' }}">
                    <label for="medico_id">Médico</label>
                    <select class="form-control" id="medico_id" name="medico_id" readonly>
                        <option value="">Seleccione un medico</option>
                        @foreach($medicos as $medico)
                            <option value="{{ $medico->id }}" {{ $medico->id == $cita->medico_id ? 'selected' : '' }}>{{ $medico->nombreMedico }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="select-examen" style="{{ $cita->exam ? '' : 'display:none;' }}">
                    <label for="exam_id">Examen:</label>
                    <select class="form-control" id="exam_id" name="exam_id" readonly>
                        <option value="">Seleccione un examen</option>
                        @foreach ($exams as $exam)
                            <option value="{{ $exam->id }}" {{ $exam->id == $cita->exam_id ? 'selected' : '' }}>{{ $exam->nombreExamen }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="estadoCita">Estado:</label>
                    <select class="form-control" name="estadoCita" id="estadoCita">
                        <option value="Agendada" @if($cita->estadoCita == 'Agendada') selected @endif>Agendada</option>
                        <option value="Cancelada" @if($cita->estadoCita == 'Cancelada') selected @endif>Cancelada</option>
                    </select>
                </div>

                <br>

                <!-- Botones -->
                <div class="text-center">
                    <a href="/citas" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
                <!-- Botones -->        
            </form>
        </div>
    </div>
</div>
<!-- Card -->


@endsection