<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Torneo;
use App\Models\Categoria;
use App\Models\Inscripcion_torneo;

class TorneosUserController extends Controller
{
    public function indextorneo()
    {
        $torneos = Torneo::all();

        $query = DB::table('categorias')
            ->leftJoin('torneos', function ($join) {
                $join->on('categorias.id', '=', 'torneos.id_categoria');
            })
            ->select('torneos.id', 'categorias.categoria', 'torneos.organizador', 'torneos.nombre_torneo', 'torneos.modalidad', 'torneos.cupos_totales',
                'torneos.cupos_disponibles', 'torneos.fecha_inicio', 'torneos.hora_inicio', 'torneos.costo_inscripcion', 'torneos.estado');
        
        $torneos = $query->get();

        return view('usuario.index-torneos', ['torneos' => $torneos]);
    }

    public function inscripciones($id)
    {
        $user = auth()->user();
        $torneo = Torneo::find($id);

        $inscrito = Inscripcion_torneo::where('id_torneo', $id)
                                    ->where('id_usuario', $user->id)
                                    ->first();

        if ($inscrito) {
            return response()->json(['error' => 'Ya estas inscrito'], 400);
        }

        if ($torneo->cupos_disponibles <= 0) {
            return response()->json(['error' => 'No hay cupos disponibles'], 400);
        }

        $new_inscrito = Inscripcion_torneo::create([
            'id_torneo' => $torneo->id,
            'id_usuario' => $user->id,
            'puntaje' => 0,
        ]);

        $torneo->decrement('cupos_disponibles');

        return redirect()->route('usuario.index-torneos');
    }
}
