@extends('adminlte::page')
@section('title', 'Editar | Paciente')
@section('content')

<!-- Card -->
<div class="d-flex">
    <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
        <h5 class="card-header text-center text-white bg-dark">Actualizar Paciente</h5>
        <div class="card-body">
            <!-- Formulario -->
            <form method="POST" action="{{ route('pacientes.update', $paciente->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="carnetPaciente">Carnet de paciente:</label>
                    <input type="text" class="form-control @error('carnet') is-invalid @enderror" id="carnetPaciente" name="carnetPaciente" value="{{ $paciente->carnetPaciente }}" required>
                    @error('carnet')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nombreCompleto">Nombre:</label>
                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombreCompleto" name="nombreCompleto" value="{{ $paciente->nombreCompleto }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="telefonoPaciente">Teléfono:</label>
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefonoPaciente" name="telefonoPaciente" value="{{ $paciente->telefonoPaciente }}" required>
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            <!-- Botones -->
            <div class="text-center">
                <a href="/pacientes" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
            <!-- Botones -->

            </form>
        </div>
    </div>
</div>
<!-- Card -->

@endsection