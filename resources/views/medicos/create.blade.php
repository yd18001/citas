@extends('adminlte::page')
@section('title', 'Registrar | Medico')
@section('content')

    <!-- Card -->
    <div class="d-flex">
        <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
            <h5 class="card-header text-center text-white bg-dark">Agregar Nuevo Medico</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('medicos.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nombreMedico">Nombre del Medico:</label>
                        <input type="text" class="form-control" id="nombreMedico" name="nombreMedico" required>
                    </div>

                    <div class="form-group">
                        <label for="limiteCitas">Limite de Citas</label>
                        <input type="number" max="20" min="1" class="form-control" id="limiteCitas"
                            name="limiteCitas" required>
                    </div>

                    <div class="form-group">
                        <label for="estadoMedico">Estado</label>
                        <select class="form-control" name="estadoMedico" id="estadoMedico">
                            <option value="" selected disabled>Seleccionar estado</option>
                            <option value="1">Disponible</option>
                            <option value="0">No disponible</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="especialidad">Especialidad:</label>
                        <select class="form-control" id="especialidad" name="especialidad">
                            <option value="" selected disabled>Seleccionar especialidad</option>
                            @foreach ($Especialidad as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->nombreEspecialidad }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="text-center">
                        <a href="/medicos" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Crear Medico</button>
                    </div>
                    <!-- Botones -->
                </form>
            </div>
        </div>
    </div>
    <!-- Card -->

@endsection
