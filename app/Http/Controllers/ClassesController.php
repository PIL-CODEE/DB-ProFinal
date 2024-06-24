<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Clase;
use App\Models\Categoria;

class ClassesController extends Controller
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
                'clases.hora_fin', 'clases.costo_inscripcion', 'clases.estado');
        
        $clases = $query->get();

        return view('administrador.clases', ['clases' => $clases]);
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
        Clase::where('id', $id)->update([
            'id_categoria' => $request->categoria,
            'instructor' => $request->instructor,
            'cupos_totales' => $request->cupos_totales,
            'cupos_disponibles' => $request->cupos_totales,
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
