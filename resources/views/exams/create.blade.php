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
                <div class="form-group">
                    <label for="nombreExamen">Nombre:</label>
                    <input type="text" class="form-control" id="nombreExamen" name="nombreExamen" required autofocus>
                </div>
    
                <div class="form-group">
                    <label for="clinica">Clinica:</label>
                    <select class="form-control" id="clinica" name="clinica" required>
                        option value="" selected disabled>Seleccionar Clinica</option>
                            <option value="clinica">Antiguo Cuscatlán</option>
                            <option value="clinica">Quezaltepeque</option>
                    </select>
                </div>
    
                <div class="form-group">
                    <label for="limiteCitas">Limite de Citas:</label>
                    <input type="number" max="20" min="1" class="form-control" id="limiteCitas" name="limiteCitas" required>
                </div>
                
                <div class="form-group">
                    <label for="estadoExamen">Estado:</label>
                    <select class="form-control" id="estadoExamen" name="estadoExamen" required>
                        <option value="" selected disabled>Seleccionar estado</option>
                        <option value="1">Disponible</option>
                        <option value="0">No disponible</option>
                    </select>
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