@extends('adminlte::page')
@section('title', 'Registrar | Especialidad')
@section('content')

<!-- Card -->
<div class="d-flex">
    <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
        <h5 class="card-header text-center text-white bg-dark">Agregar Especialidad</h5>
        <div class="card-body">
            <form action="{{ route('especialidades.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombreEspecialidad">Nombre:</label>
                    <input type="text" class="form-control" name="nombreEspecialidad" required>
                </div>
                <div class="form-group">
                    <label for="clinica">Clinica:</label>
                    <select class="form-control @error('clinica') is-invalid @enderror" id="clinica" name="clinica" required>
                        <option value="" selected disabled>Seleccionar Clinica</option>
                        <option value="Antiguo Cuscatlán">Antiguo Cuscatlán</option>
                        <option value="Quezaltepeque">Quezaltepeque</option>
                    </select>
                    @error('clinica')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="estadoEspecialidad">Estado:</label>
                    <select class="form-control" name="estadoEspecialidad" id="estadoEspecialidad" required>
                        <option value="" selected disabled>Seleccionar estado</option>
                        <option value="1">Disponible</option>
                        <option value="0">No disponible</option>
                    </select>
                </div>
                <!-- Botones -->
                <div class="text-center">
                    <a href="/especialidades" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Crear Especialidad</button>
                </div>
                <!-- Botones -->
            </form>
        </div>
    </div>
</div>
<!-- Card -->

@endsection
