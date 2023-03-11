@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content')

    <!-- script de dependencia de fullcalendar para mostrar el calendario -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

    <!--script para crear el calendario y sus eventos (citas)-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Crear un segundo objeto de calendario para el mini calendario
            var minicalendarEl = document.getElementById('mini-calendar');

            var minicalendar = new FullCalendar.Calendar(minicalendarEl, {
                headerToolbar: false,
                locale: 'es',
                initialView: 'dayGridMonth',
                eventColor: '#000',
                eventTextColor: '#fff',
                events: {!! json_encode($eventos) !!},
                scrollTime: null,
                height: 'auto' //Muestra los eventos en el calendario
            });
            // Renderizar el mini calendario
            minicalendar.render();

        });
    </script>


    <!-- Contenedor principal-->
    <div class="container">
        <br>
        <div class="row">

            <div class="col-md-3">
                <div class="small-box bg-gradient-gray">
                    <div class="inner">
                        <h3>{{ $citas->count() }}</h3>
                        <p>Citas Registradas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="citas" class="small-box-footer">
                        Ver <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-navy">
                    <div class="inner">
                        <h3>{{ $especialidades->count() }}</h3>
                        <p>Especialidades Disponibles</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-briefcase-medical"></i>
                    </div>
                    <a href="especialidades" class="small-box-footer">
                        Ver <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-dark">
                    <div class="inner">
                        <h3>{{ $medicos->count() }}</h3>
                        <p>Medicos Disponibles</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <a href="medicos" class="small-box-footer">
                        Ver <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $exams->count() }}</h3>
                        <p>Examenes Disponibles</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-prescription-bottle"></i>
                    </div>
                    <a href="exams" class="small-box-footer">
                        Ver <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Calendario en miniatura -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex"></div>
                        <div id="mini-calendar" data-section="mini-calendar"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nombre completo</th>
                                    <th>Teléfono</th>
                                    <th>Médico</th>
                                    <th>Examen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($citasDelDia as $cita)
                                    <tr>
                                        <td>{{ $cita->nombreCompleto }}</td>
                                        <td>{{ $cita->numeroTelefono }}</td>
                                        <td>{{ $cita->medicos ? $cita->medicos->nombreMedico : 'N/A' }}</td>
                                        <td>{{ $cita->exams ? $cita->exams->nombreExamen : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>



    </div>

@endsection
