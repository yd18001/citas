@extends('adminlte::page')
@section('title', 'Medicos')
@section('content')

    <style>
        table {
            text-align: center;
            box-shadow: 0px 0px 15px #454545;
            -moz-box-shadow: 0px 0px 15px #454545;
            filter: progid:DXImageTransform.Microsoft.Shadow(color='#454545', Direction=135, Strength=4);
        }

        .pagination .page-item.active .page-link {
            color: white;
            background-color: #343a40;
            border-color: #343a40;
        }

        .page-item.disabled .page-link {
            color: #000;
        }

        .page-link {
            color: #343a40;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="col-md-12">
                    <br>
                    <h1 class="display-5 text-center">Listado de Medicos</h1>
                    <span class="tt" data-bs-placement="bottom" title="Agrega una nuevo medico">
                        <a href="medicos/create" class="btn btn-dark">Agregar Nuevo Medico</a>
                    </span>
                    <br> <br>
                </div>
                <div class="card mx-auto">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr class="bg-title">
                                        <th scope="col">Nombre Medico</th>
                                        <th scope="col">Limite de Citas</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Especialidad</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($medicos as $medico)
                                        <tr>
                                            <td>{{ $medico->nombreMedico }}</td>
                                            <td>{{ $medico->limiteCitas }}</td>
                                            <td>{{ $medico->estadoTexto() }}</td>
                                            <td>{{ App\Models\Especialidad::find($medico->id_especialidad)->nombreEspecialidad }}
                                            </td>
                                            <td>
                                                <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST">
                                                    <a href="/medicos/{{ $medico->id }}/edit" class="btn btn-secondary"
                                                        title="Edita medico">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-pencil-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                        </svg>
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"class="btn btn-danger" title="Elimina Medico"
                                                        onclick="return confirm('¿Está seguro de que desea eliminar al médico?')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-trash-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $medicos->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
