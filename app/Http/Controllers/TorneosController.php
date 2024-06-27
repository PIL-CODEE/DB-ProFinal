<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Torneo;
use App\Models\Categoria;
use App\Models\Inscripcion_torneo;
use App\Models\User;

class TorneosController extends Controller
{
    public function indextorneo(Request $request)
    {
        $torneos = Torneo::all();

        $query = DB::table('categorias')
            ->leftJoin('torneos', function ($join) {
                $join->on('categorias.id', '=', 'torneos.id_categoria');
            })
            ->select('torneos.id', 'categorias.categoria', 'torneos.organizador', 'torneos.nombre_torneo', 'torneos.modalidad', 'torneos.cupos_totales',
                'torneos.cupos_disponibles', 'torneos.fecha_inicio', 'torneos.hora_inicio', 'torneos.costo_inscripcion', 'torneos.estado');
        
        $torneos = $query->get();

        $busqueda = $request->nombre_inscrito;
        $id_torneo = $request->id_torneo;
        $search_inscrito = collect();

            if ($busqueda == "Todos") {

                $search_inscrito = DB::table('users')
                ->leftJoin('inscripcion_torneos', 'users.id', '=', 'inscripcion_torneos.id_usuario')
                ->where('inscripcion_torneos.id_torneo', $id_torneo)
                ->select('inscripcion_torneos.id_torneo', 'users.name')
                ->get();

            } elseif ($busqueda) {

                $user = User::where('name', $busqueda)->first();

                if ($user) {
                    $search_inscrito = DB::table('users')
                        ->leftJoin('inscripcion_torneos', 'users.id', '=', 'inscripcion_torneos.id_usuario')
                        ->where('users.id', $user->id)
                        ->where('inscripcion_torneos.id_torneo', $id_torneo)
                        ->select('inscripcion_torneos.id_torneo', 'users.name')
                        ->get();
                }
            };

        $data = [
            'torneos' => $torneos,
            'search_inscrito' => $search_inscrito,
        ];

        return view('administrador.torneos', $data);
    }

    public function deactivate($id)
    {
        $update_state = Torneo::where('id', $id)->update([
            'estado' => "Terminado",
            ]);
        
        return redirect()->route('administrador.torneos');
    }

    public function activate($id)
    {
        $update_state = Torneo::where('id', $id)->update([
            'estado' => "Activo",
            ]);
        
        return redirect()->route('administrador.torneos');
    }

    public function torneocreate()
    {
        $categorias = Categoria::all();
        
        return view('administrador.create-torneos', ['categorias' => $categorias]);
    }

    public function createtorneo(Request $request)
    {
        // Validar los datos enviados desde un formulario
        $validate_class = $request->validate([
            'categoria' => 'required|integer',
            'instructor' => 'required|string|max:100',
            'cupos_totales' => 'required|integer|min:0|max:100',
            'duracion' => 'required|string|max:100',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
            'costo_inscripcion' => 'required|integer|min:0',
            'descripcion' => 'required|string',
        ]);

        if ($validate_class) {

            $new_class = Clase::create([
                'id_categoria' => $request->categoria,
                'instructor' => $request->instructor,
                'cupos_totales' => $request->cupos_totales,
                'cupos_disponibles' => $request->cupos_totales,
                'duracion' => $request->duracion,
                'fecha_inicio' => $request->fecha_inicio,
                'hora_inicio' => $request->hora_inicio,
                'hora_fin' => $request->hora_fin,
                'costo_inscripcion' => $request->costo_inscripcion,
                'estado' => "Activo",
                'descripcion' => $request->descripcion,
            ]);

            return redirect()->route('administrador.clases');
        }

    }


}
