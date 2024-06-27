<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TorneosController extends Controller
{
    public function indexclass(Request $request)
    {
        $clases = Clase::all();

        $query = DB::table('categorias')
            ->leftJoin('clases', function ($join) {
                $join->on('categorias.id', '=', 'clases.id_categoria');
            })
            ->select('clases.id', 'categorias.categoria', 'clases.instructor', 'clases.cupos_totales',
                'clases.cupos_disponibles', 'clases.duracion', 'clases.fecha_inicio', 'clases.hora_inicio',
                'clases.hora_fin', 'clases.costo_inscripcion', 'clases.estado');
        
        $clases = $query->get();

        $busqueda = $request->nombre_inscrito;
        $id_clase = $request->id_clase;
        $search_inscrito = collect();

            if ($busqueda == "Todos") {

                $search_inscrito = DB::table('users')
                ->leftJoin('inscripcion_clases', 'users.id', '=', 'inscripcion_clases.id_usuario')
                ->where('inscripcion_clases.id_clase', $id_clase)
                ->select('inscripcion_clases.id_clase', 'users.name')
                ->get();

            } elseif ($busqueda) {

                $user = User::where('name', $busqueda)->first();

                if ($user) {
                    $search_inscrito = DB::table('users')
                        ->leftJoin('inscripcion_clases', 'users.id', '=', 'inscripcion_clases.id_usuario')
                        ->where('users.id', $user->id)
                        ->where('inscripcion_clases.id_clase', $id_clase)
                        ->select('inscripcion_clases.id_clase', 'users.name')
                        ->get();
                }
            };

        $data = [
            'clases' => $clases,
            'search_inscrito' => $search_inscrito,
        ];

        return view('administrador.clases', $data);
    }

    public function classcreate()
    {
        $categorias = Categoria::all();
        
        return view('administrador.create-clases', ['categorias' => $categorias]);
    }

    public function createclass(Request $request)
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

    public function deactivate($id)
    {
        $update_state = Clase::where('id', $id)->update([
            'estado' => "Terminado",
            ]);
        
        return redirect()->route('administrador.clases');
    }

    public function activate($id)
    {
        $update_state = Clase::where('id', $id)->update([
            'estado' => "Activo",
            ]);
        
        return redirect()->route('administrador.clases');
    }

    public function editclass($id)
    {
        $clases = Clase::all()->where('id', $id);
        
        $categorias = Categoria::all();
        
        $data = [
            'clases' => $clases,
            'categorias' => $categorias
        ];
    
        return view('administrador.update-clases', $data);
    }

    public function updateclass(Request $request, $id)
    {
        $clase = Clase::find($id);

        if ($clase->cupos_disponibles == $clase->cupos_totales) {
            Clase::where('id', $id)->update([
                'cupos_disponibles' => $request->cupos_totales,
            ]);
        } elseif ($clase->cupos_disponibles < $clase->cupos_totales) {
            $a = $clase->cupos_totales;
            $b = $request->cupos_totales;
            $c = $b - $a;

            $d = $clase->cupos_disponibles;
            $e = $d + $c;

            Clase::where('id', $id)->update([
                'cupos_disponibles' => $e,
            ]);
        } elseif ($clase->cupos_disponibles > $request->cupos_totales) {
            $a = $clase->cupos_totales;
            $b = $request->cupos_totales;
            $c = $a - $b;

            $d = $clase->cupos_disponibles;
            $e = $d - $c;

            Clase::where('id', $id)->update([
                'cupos_disponibles' => $e,
            ]);
        };

        Clase::where('id', $id)->update([
            'id_categoria' => $request->categoria,
            'instructor' => $request->instructor,
            'cupos_totales' => $request->cupos_totales,
            'duracion' => $request->duracion,
            'fecha_inicio' => $request->fecha_inicio,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'costo_inscripcion' => $request->costo_inscripcion,
            'descripcion' => $request->descripcion,
            ]);

        return redirect()->route('administrador.clases');
    }

    public function deleteclass($id)
    {
        $delete_class = Clase::where('id', $id);
        $delete_class->delete();

        return redirect()->route('administrador.clases');
    }
}
