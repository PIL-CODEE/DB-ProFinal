<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clase;
use App\Models\Categoria;
use App\Models\Inscripcion_clase;

class ClassesUserController extends Controller
{
    public function indexclass()
    {
        $clases = Clase::all();

        $query = DB::table('categorias')
            ->leftJoin('clases', function ($join) {
                $join->on('categorias.id', '=', 'clases.id_categoria');
            })
            ->select('clases.id', 'categorias.categoria', 'clases.instructor', 'clases.cupos_totales',
                'clases.cupos_disponibles', 'clases.duracion', 'clases.fecha_inicio', 'clases.hora_inicio',
                'clases.hora_fin', 'clases.costo_inscripcion', 'clases.estado', 'clases.descripcion');
        
        $clases = $query->get();

        return view('usuario.index-clases', ['clases' => $clases]);
    }

    public function inscripciones($id)
    {
        $user = auth()->user();
        $clase = Clase::find($id);

        $inscrito = Inscripcion_clase::where('id_clase', $id)
                                    ->where('id_usuario', $user->id)
                                    ->first();

        if ($inscrito) {
            return response()->json(['error' => 'Ya estas inscrito'], 400);
        }

        if ($clase->cupos_disponibles <= 0) {
            return response()->json(['error' => 'No hay cupos disponibles'], 400);
        }

        $new_inscrito = Inscripcion_clase::create([
            'id_clase' => $clase->id,
            'id_usuario' => $user->id,
        ]);

        $clase->decrement('cupos_disponibles');

        return redirect()->route('usuario.index-clases');
    }
    
}
