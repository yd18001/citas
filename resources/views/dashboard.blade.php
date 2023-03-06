    @extends('adminlte::page')
    @section('title', 'Dashboard')
    @section('content')

        <!-- script de dependencia de fullcalendar para mostrar el calendario -->
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!--script para crear el calendario y sus eventos (citas)-->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    locale: 'es',
                    initialView: 'dayGridMonth',
                    eventColor: '#007bff',
                    eventTextColor: '#fff',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                    },
                    buttonText: {
                        today: 'Hoy',
                        month: 'Mes',
                        week: 'Semana',
                        day: 'Día',
                        list: 'Agenda'
                    },
                    events: {!! json_encode($eventos) !!} //Muestra los eventos en el calendario
                });
                calendar.render();

            });
        </script>


        <!-- Contenedor principal-->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="col-md-12" style="text-align: center">
                        <h1>Calendario</h1>
                    </div>
                    <div class="card mx-auto">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <div class="card-body">
                            <form id="filtro-form" class="ajax-form" method="GET" action="{{ route('dashboard.index') }}"
                                data-section="calendar">
                                @csrf
                                <div class="row mb-4">
                                    <!-- Menú desplegable -->
                                    <div class="col-md-4 d-flex align-items-center">
                                        <label class="col-md-4 col-form-label" for="filtro">Filtrar por:</label>
                                        <select class="form-control" id="filtro" name="filtro">
                                            <option value="">Todos</option>
                                            @foreach ($medicos as $medico)
                                                <option value="medico_{{ $medico->id }}"
                                                    @if ($filtro == 'medico_' . $medico->id) selected @endif>
                                                    {{ $medico->nombreMedico }}
                                                </option>
                                            @endforeach
                                            @foreach ($exams as $exam)
                                                <option value="exam_{{ $exam->id }}"
                                                    @if ($filtro == 'exam_' . $exam->id) selected @endif>
                                                    {{ $exam->nombreExamen }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- Botón de Filtro -->
                                        <button type="submit" id="filter-button" class="btn btn-primary mr-2 ml-2"
                                            form="filtro-form" data-action="load-data">Filtrar</button>
                                    </div>
                                    <!-- Botón de Agendar Cita -->
                                    <div class="col-md-8 d-flex justify-content-end align-items-center">
                                        <a href="{{ route('citas.create') }}" id="agendarCita"
                                            class="btn btn-success ml-auto">Agendar cita</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!-- Calendario -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex"></div>
                            <div id="calendar" data-section="calendar"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    @endsection
