@extends('adminlte::page')
@section('title', 'Registrar | Paciente')
@section('content')

<!-- Card -->
<div class="d-flex">
    <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
        <h5 class="card-header text-center text-white bg-dark">Agregar Paciente</h5>
        <div class="card-body">
            <!-- Formulario -->
            <form method="POST" action="{{ route('pacientes.store') }}">
            @csrf

            <div class="form-group{{ $errors->has('carnetPaciente') ? ' has-error' : '' }}">
                <label for="carnetPaciente" class="control-label">Carnet</label>
                <input id="carnetPaciente" type="text" class="form-control" name="carnetPaciente" value="{{ old('carnetPaciente') }}" required autofocus>
                    @if ($errors->has('carnetPaciente'))
                        <span class="help-block">
                            <strong>{{ $errors->first('carnetPaciente') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('nombreCompleto') ? ' has-error' : '' }}">
                <label for="nombreCompleto" class="control-label">Nombre</label>
                <input id="nombreCompleto" type="text" class="form-control" name="nombreCompleto" value="{{ old('nombreCompleto') }}" required>
                    @if ($errors->has('nombreCompleto'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombreCompleto') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('telefonoPaciente') ? ' has-error' : '' }}">
                <label for="telefonoPaciente" class="control-label">Teléfono</label>
                <input id="telefonoPaciente" type="text" class="form-control" name="telefonoPaciente" value="{{ old('telefonoPaciente') }}" required>
                    @if ($errors->has('telefonoPaciente'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telefonoPaciente') }}</strong>
                        </span>
                    @endif
            </div>

            <!-- Botones -->
            <div class="text-center">
                <a href="/pacientes" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            <!-- Botones -->

            </form>
        </div>
    </div>
</div>
<!-- Card -->

@endsection