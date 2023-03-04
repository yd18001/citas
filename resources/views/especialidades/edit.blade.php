@extends('adminlte::page')
@section('title', 'Editar | Especialidad')
@section('content')
<!-- Card -->
<div class="d-flex">
    <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
        <h5 class="card-header text-center text-white bg-dark">Editar Especialidad</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('especialidades.update', $especialidad->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="nombreEspecialidad" class="col-md-4 col-form-label text-md-right">{{ __('Nombre Especialidad') }}</label>

                    <div class="col-md-6">
                        <input id="nombreEspecialidad" type="text" class="form-control @error('nombreEspecialidad') is-invalid @enderror" name="nombreEspecialidad" value="{{ $especialidad->nombreEspecialidad }}" required autofocus>

                        @error('nombreEspecialidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="clinica" class="col-md-4 col-form-label text-md-right">{{ __('Clinica') }}</label>

                    <div class="col-md-6">
                        <select class="form-control @error('clinica') is-invalid @enderror" id="clinica" name="clinica" value="{{$especialidad->clinica}}">
                            <option value="" selected disabled>Seleccionar Clinica</option>
                            <option value="clinica">Antiguo Cuscatlán</option>
                            <option value="clinica">Quezaltepeque</option>
                        </select>

                        @error('clinica')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="estadoEspecialidad" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                    <div class="col-md-6">
                        <select id="estadoEspecialidad" class="form-control @error('estadoEspecialidad') is-invalid @enderror" name="estadoEspecialidad" required>
                            <option value="1" {{ $especialidad->estadoEspecialidad == 1 ? 'selected' : '' }}>Activo</option>
                            <option value="0" {{ $especialidad->estadoEspecialidad == 0 ? 'selected' : '' }}>Inactivo</option>
                        </select>

                        @error('estadoEspecialidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>                
                <!-- Botones -->
                <div class="text-center">
                    <a href="/especialidades" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
                <!-- Botones -->
            </form>
        </div>
    </div>
</div>
<!-- Card -->

@endsection
