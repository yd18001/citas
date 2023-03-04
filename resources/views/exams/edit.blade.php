@extends('adminlte::page')
@section('title', 'Actualizar | Examen')
@section('content')

<!-- Card -->
<div class="d-flex">
    <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
        <h5 class="card-header text-center text-white bg-dark">Actualizar Examen</h5>
        <div class="card-body">
            <form action="{{ route('exams.update', $exam->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombreExamen">Nombre:</label>
                <input type="text" class="form-control" id="nombreExamen" name="nombreExamen" value="{{ $exam->nombreExamen }}">
            </div>

            <div class="form-group">
                <label for="clinica">Clinica:</label>
                <select class="form-control" id="clinica" name="clinica">
                    <option value="clinica" {{ $exam->clinia ? 'selected' : '' }}>Antiguo Cuscatlán</option>
                    <option value="clinica" {{ !$exam->clinica ? 'selected' : '' }}>Quezaltepeque</option>
                </select>
            </div>

            <div class="form-group">
                <label for="limiteCitas">Limite de Citas:</label>
                <input type="number" max="20" min="1" class="form-control" id="limiteCitas" name="limiteCitas" value="{{ $exam->limiteCitas }}">
            </div>
            
            <div class="form-group">
                <label for="estadoExamen">Estado:</label>
                <select class="form-control" id="estadoExamen" name="estadoExamen">
                    <option value="1" {{ $exam->estadoExamen ? 'selected' : '' }}>Disponible</option>
                    <option value="0" {{ !$exam->estadoExamen ? 'selected' : '' }}>No disponible</option>
                </select>
            </div>
            <!-- Botones -->
            <div class="text-center">
                    <a href="/exams" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
                <!-- Botones -->
            </form> 
        </div>
    </div>
</div>
<!-- Card -->

@endsection