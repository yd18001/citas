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

                    <div class="form-group">
                        <label for="nombreEspecialidad">Nombre:</label>
                        <input type="text" class="form-control" name="nombreEspecialidad"
                            value="{{ $especialidad->nombreEspecialidad }}" required>
                    </div>
                    <div class="form-group">
                        <label for="clinica">Clinica:</label>
                        <select class="form-control @error('clinica') is-invalid @enderror" id="clinica" name="clinica"
                            value="{{ $especialidad->clinica }}" required>
                            <option value="clinica">Antiguo Cuscatlán</option>
                            <option value="clinica">Quezaltepeque</option>
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
                            <option value="1" {{ $especialidad->estadoEspecialidad == 1 ? 'selected' : '' }}>Disponible
                            </option>
                            <option value="0" {{ $especialidad->estadoEspecialidad == 0 ? 'selected' : '' }}>No
                                Disponible
                            </option>
                        </select>
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
