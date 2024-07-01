<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\Grupo;
use App\Models\EstudianteGrupo;
use Carbon\Carbon;



class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Asistencia::query();

        if ($request->has('estudiante_id') && is_numeric($request->estudiante_id)) {
            $query->where('estudiante_id', '=', $request->estudiante_id);
        }

        if ($request->has('grupo_id') && is_numeric($request->grupo_id)) {
            $query->where('grupo_id', '=', $request->grupo_id);
        }

        $asistencias = $query->with('estudiante', 'grupo')
            ->orderBy('id', 'desc')
            ->simplePaginate(10);

        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();

        return view('asistencias.index', compact('asistencias', 'estudiantes', 'grupos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
        return view('asistencias.create', compact('estudiantes', 'grupos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $asistencia = Asistencia::create($request->all());

        return redirect()->route('asistencias.index')->with('success', 'Asistencia creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }

        return view('asistencias.show', compact('asistencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }

        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();

        return view('asistencias.edit', compact('asistencia', 'estudiantes', 'grupos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        // Validación solo de los campos fecha y hora_entrada
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }

        $asistencia->grupo_id = $request->grupo_id;
        $asistencia->estudiante_id = $request->estudiante_id;
        $asistencia->fecha = $request->fecha;
        $asistencia->hora_entrada = $request->hora_entrada;

        $asistencia->save();

        return redirect()->route('asistencias.index')->with('success', 'Asistencia actualizada correctamente');
    }

    public function delete($id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }

        return view('asistencias.delete', compact('asistencia'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }

        $asistencia->delete();

        return redirect()->route('asistencias.index')->with('success', 'Asistencia eliminada correctamente');
    }

    public function asistencia()
    {
        $estudiantes = Estudiante::all();
        $grupos = Grupo::all();
        return view('asistencias.marcarAsistencia', compact('estudiantes', 'grupos'));
    }

    public function asistenciaStore(Request $request)
    {
        $pin = $request->input('pin');

        $estudiante = Estudiante::where('pin', $pin)->first();

        if (!$estudiante) {
            return redirect()->route('asistencias.marcarAsistencia')->with('error', 'El PIN del estudiante no es válido');
        }

        $estudianteGrupo = EstudianteGrupo::where('estudiante_id', $estudiante->id)->first();

        if (!$estudianteGrupo) {
            return redirect()->route('asistencias.marcarAsistencia')->with('error', 'El estudiante no pertenece a ningún grupo');
        }

        $grupoId = $estudianteGrupo->grupo_id;

        date_default_timezone_set("America/El_Salvador");
        $fecha = Carbon::now()->toDateString();
        $horaEntrada = Carbon::now()->toTimeString();

        $asistencia = Asistencia::create([
            'grupo_id' => $grupoId,
            'estudiante_id' => $estudiante->id,
            'fecha' => $fecha,
            'hora_entrada' => $horaEntrada,
        ]);

        return redirect()->route('asistencias.index')->with('success', 'Asistencia creada correctamente');
    }
}
