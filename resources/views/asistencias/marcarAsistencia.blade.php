@extends('layouts.app')

@section('content')
@if (session('error'))
    <div class="alert alert-danger fade show" id="success-message" data-bs-dismiss="alert" role="alert">
        {{ session('error') }}
    </div>
@endif
    <h1>Marcar Asistencia</h1>
    <form action="{{ route('asistencias.asistenciaStore') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="pin" class="form-label">Ingrese Pin estudiante</label>
                <input type="text" class="form-control" id="pin" name="pin" required>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-success">Marcar Asistencia</button>
                <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
