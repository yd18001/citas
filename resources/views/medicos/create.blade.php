@extends('adminlte::page')
@section('title', 'Registrar | Medicos')
@section('content')

<!-- Card -->
<div class="d-flex">
    <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
        <h5 class="card-header text-center text-white bg-dark">Agregar Nuevo Medico</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('medicos.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="nombreMedico" class="col-md-4 col-form-label text-md-right">Nombre Médico</label>
                    <div class="col-md-6">
                        <input id="nombreMedico" type="text" class="form-control @error('nombreMedico') is-invalid @enderror" name="nombreMedico" value="{{ old('nombreMedico') }}" required autocomplete="nombreMedico">
                        @error('nombreMedico')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            
                <div class="form-group row">
                    <label for="limiteCitas" class="col-md-4 col-form-label text-md-right">Limite de Citas</label>
                    <div class="col-md-6">
                        <input id="limiteCitas" type="number" max="20" min="1" class="form-control @error('limiteCitas') is-invalid @enderror" name="limiteCitas" value="{{ old('limiteCitas') }}" required autocomplete="limiteCitas">
                        @error('limiteCitas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            
                <div class="form-group row">
                    <label for="estadoMedico" class="col-md-4 col-form-label text-md-right">Estado</label>
                    <div class="col-md-6">
                        <select id="estadoMedico" name="estadoMedico" class="form-control @error('estadoMedico') is-invalid @enderror" required>
                            <option value="" selected disabled>Seleccionar estado</option>
                            <option value="1">Disponible</option>
                            <option value="0">No disponible</option>
                        </select>
                        @error('estadoMedico')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            
                <div class="form-group row">
                    <label for="id_especialidad" class="col-md-4 col-form-label text-md-right">Especialidad</label>
                    <div class="col-md-6">
                        <select id="id_especialidad" class="form-control @error('id_especialidad') is-invalid @enderror" name="id_especialidad" required>
                            <option value="" selected disabled>Seleccionar especialidad</option>
                            @foreach($Especialidad as $especialidad)
                            <option value="{{ $especialidad->id }}">{{ $especialidad->nombreEspecialidad }}</option>
                            @endforeach
                        </select>
                        @error('id_especialidad')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
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