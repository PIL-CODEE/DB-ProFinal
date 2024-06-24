<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clase;
use App\Models\Categoria;

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
        // Encuentra la clase por su ID
        $clase = Clase::find($id);

        // Verifica si la clase existe y si hay cupos disponibles
        if ($clase && $clase->cupos_disponibles > 0) {
            // Decrementa los cupos disponibles en 1
            $clase->decrement('cupos_disponibles');

            return redirect()->route('usuario.index-clases');

        } else {
            // Opcional: puedes manejar el caso en que no haya cupos disponibles
            return response()->json(['error' => 'No hay cupos disponibles'], 400);
        }
    }
    
}
