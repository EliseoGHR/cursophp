@extends('layouts.app')

@section('content')
@if (session('success'))
    <div class="alert alert-success fade show" id="success-message" data-bs-dismiss="alert" role="alert">
        {{ session('success') }}
    </div>
@endif

<h1>Lista asistencias</h1>

<form action="{{ route('asistencias.index') }}" method="GET">
    @csrf
    <div class="row">
        <div class="col-sm-4">
            <label for="estudiante_id" class="form-label">Estudiante</label>
            <select name="estudiante_id" class="form-control">
                <option value="">Seleccione un estudiante</option>
                @foreach ($estudiantes as $estudiante)
                    <option value="{{ $estudiante->id }}">{{ $estudiante->nombre }} {{ $estudiante->apellido }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <a href="{{ route('asistencias.create') }}" class="btn btn-secondary">Ir a crear</a>
            <a href="{{ route('asistencias.marcarAsistencia') }}" class="btn btn-success">Marcar Asistencia</a>

        </div>
    </div>



</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Estudiante</th>
            <th>Grupo</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($asistencias as $asistencia)
        <tr>
            <td>{{ $asistencia->estudiante->nombre }} {{ $asistencia->estudiante->apellido }}</td>
            <td>{{ $asistencia->grupo->nombre }}</td>
            <td>{{ $asistencia->fecha }}</td>
            <td>{{ \Carbon\Carbon::parse($asistencia->hora_entrada)->format('h:i A') }}</td>
            <td>
                <table>
                    <tr>
                        <td>
                            <a href="{{ route('asistencias.edit', $asistencia->id) }}" class="btn btn-warning">Editar</a>
                        </td>
                        <td>
                            <a href="{{ route('asistencias.show', $asistencia->id) }}" class="btn btn-info">Ver</a>
                        </td>
                        <td>
                            <a href="{{ route('asistencias.delete', $asistencia->id) }}" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-sm-12">
        {{ $asistencias->links() }}
    </div>
</div>

@endsection
