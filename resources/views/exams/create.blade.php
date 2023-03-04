@extends('adminlte::page')
@section('title', 'Registrar | Examenes')
@section('content')

<!-- Card -->
<div class="d-flex">
    <div class="card mx-auto" style="width: 60%; margin-top: 2%;">
        <h5 class="card-header text-center text-white bg-dark">Agregar Nuevo Examen</h5>
        <div class="card-body">
            <form method="POST" action="{{ route('exams.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="nombreExamen" class="col-md-4 col-form-label text-md-right">{{ __('Nombre del examen') }}</label>
                    <div class="col-md-6">
                        <input id="nombreExamen" type="text" class="form-control @error('nombreExamen') is-invalid @enderror" name="nombreExamen" value="{{ old('nombreExamen') }}" required autocomplete="nombreExamen" autofocus>
                        @error('nombreExamen')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="clinica" class="col-md-4 col-form-label text-md-right">{{ __('Clinica') }}</label>

                    <div class="col-md-6">
                        <select class="form-control @error('clinica') is-invalid @enderror" id="clinica" name="clinica">
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
                    <label for="estadoExamen" class="col-md-4 col-form-label text-md-right">{{ __('Estado del examen') }}</label>

                    <div class="col-md-6">
                        <select class="form-control @error('estadoExamen') is-invalid @enderror" id="estadoExamen" name="estadoExamen">
                            <option value="" selected disabled>Seleccionar estado</option>
                            <option value="1">Disponible</option>
                            <option value="0">No disponible</option>
                        </select>

                        @error('estadoExamen')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="text-center">
                    <a href="/exams" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Crear Examen</button>
                </div>
                <!-- Botones -->
            
            </form>
        </div>
    </div>
</div>
<!-- Card -->

@endsection