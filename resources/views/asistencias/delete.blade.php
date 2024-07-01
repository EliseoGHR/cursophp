@extends('layouts.app')

@section('content')
<h1>Eliminar asistencia</h1>
<form action="{{ route('asistencias.destroy', $asistencia->id) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <label for="estudiante_nombre" class="form-label">Estudiante</label>
            <input type="text" class="form-control" id="estudiante_nombre"
                value="{{ $asistencia->estudiante->nombre }} {{ $asistencia->estudiante->apellido }}" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label for="grupo_nombre" class="form-label">Grupo</label>
            <input type="text" class="form-control" id="grupo_nombre" value="{{ $asistencia->grupo->nombre }}" disabled>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $asistencia->fecha }}" disabled>
        </div>
        <div class="col-md-3">
            <label for="hora_entrada">Hora de Entrada</label>
            <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" value="{{ $asistencia->hora_entrada }}" disabled>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Eliminar</button>
            <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </div>
</form>
@endsection
