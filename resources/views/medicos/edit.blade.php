@extends('adminlte::page')
@section('title', 'Actualizar | Medicos')
@section('content')

<!-- Card -->
<div class="d-flex">
    <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
        <h5 class="card-header text-center text-white bg-dark">Actualizar Medico</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('medicos.update', $medico->id) }}">
                @csrf
                @method('PATCH')
    
                <div class="form-group">
                    <label for="nombreMedico">Nombre del Medico:</label>
                    <input type="text" class="form-control" id="nombreMedico" name="nombreMedico" value="{{ $medico->nombreMedico }}" required>
                </div>
                
                <div class="form-group">
                    <label for="limiteCitas">Limite de Citas</label>
                    <input type="number" max="20" min="1" class="form-control" id="limiteCitas" name="limiteCitas" value="{{ $medico->limiteCitas }}" required>
                </div>

                <div class="form-group">
                    <label for="estadoMedico">Estado</label>
                    <select class="form-control" name="estadoMedico" id="estadoMedico">
                        <option value="1" {{ $medico->estado ? 'selected' : '' }}>Disponible</option>
                        <option value="0" {{ !$medico->estado ? 'selected' : '' }}>No disponible</option>
                    </select>
                </div>   
    
                <div class="form-group">
                    <label for="especialidad">Especialidad:</label>
                    <select class="form-control" id="especialidad" name="especialidad">
                        @foreach($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}" @if($medico->id_especialidad == $especialidad->id) selected @endif>{{ $especialidad->nombreEspecialidad }}</option>
                        @endforeach
                    </select>
                </div>             
                
                <!-- Botones -->
                <div class="text-center">
                    <a href="/medicos" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Card -->

@endsection