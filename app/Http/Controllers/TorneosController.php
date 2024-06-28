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
        $validate_torneo = $request->validate([
            'categoria' => 'required|integer',
            'organizador' => 'required|string|max:100',
            'nombre_torneo' => 'required|string|max:100',
            'modalidad' => 'required|string|max:100',
            'cupos_totales' => 'required|integer|min:0|max:100',
            'fecha_inicio' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required|date_format:H:i',
            'costo_inscripcion' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
        ]);

        if ($validate_torneo) {

            $new_torneo = Torneo::create([
                'id_categoria' => $request->categoria,
                'organizador' => $request->organizador,
                'nombre_torneo' => $request->nombre_torneo,
                'modalidad' => $request->modalidad,
                'cupos_totales' => $request->cupos_totales,
                'cupos_disponibles' => $request->cupos_totales,
                'fecha_inicio' => $request->fecha_inicio,
                'hora_inicio' => $request->hora_inicio,
                'costo_inscripcion' => $request->costo_inscripcion,
                'estado' => "Activo",
                'descripcion' => $request->descripcion,
            ]);

            return redirect()->route('administrador.torneos');
        }

    }

    public function edittorneo($id)
    {
        $torneos = Torneo::all()->where('id', $id);
        
        $categorias = Categoria::all();
        
        $data = [
            'torneos' => $torneos,
            'categorias' => $categorias
        ];
    
        return view('administrador.update-torneos', $data);
    }

    public function updatetorneo(Request $request, $id)
    {
        $torneo = Torneo::find($id);

        if ($torneo->cupos_disponibles == $torneo->cupos_totales) {
            Torneo::where('id', $id)->update([
                'cupos_disponibles' => $request->cupos_totales,
            ]);
        } elseif ($torneo->cupos_disponibles < $torneo->cupos_totales) {
            $a = $torneo->cupos_totales;
            $b = $request->cupos_totales;
            $c = $b - $a;

            $d = $torneo->cupos_disponibles;
            $e = $d + $c;

            Torneo::where('id', $id)->update([
                'cupos_disponibles' => $e,
            ]);
        } elseif ($torneo->cupos_disponibles > $request->cupos_totales) {
            $a = $torneo->cupos_totales;
            $b = $request->cupos_totales;
            $c = $a - $b;

            $d = $torneo->cupos_disponibles;
            $e = $d - $c;

            Torneo::where('id', $id)->update([
                'cupos_disponibles' => $e,
            ]);
        };

        Torneo::where('id', $id)->update([
            'id_categoria' => $request->categoria,
            'organizador' => $request->organizador,
            'nombre_torneo' => $request->nombre_torneo,
            'modalidad' => $request->modalidad,
            'cupos_totales' => $request->cupos_totales,
            'fecha_inicio' => $request->fecha_inicio,
            'hora_inicio' => $request->hora_inicio,
            'costo_inscripcion' => $request->costo_inscripcion,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('administrador.torneos');
    }

    public function deletetorneo($id)
    {
        $delete_torneo = Torneo::where('id', $id);
        $delete_torneo->delete();

        return redirect()->route('administrador.torneos');
    }
}
