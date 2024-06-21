<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
     // Definimos los atributos que se pueden asignar en masa.
     protected $fillable = ['id_categoria',
                            'instructor',
                            'cupos_totales',
                            'cupos_disponibles',
                            'duracion',
                            'fecha_inicio',
                            'hora_inicio',
                            'hora_fin',
                            'costo_inscripcion',
                            'estado'];

     public $timestamps = false;

    // Definición de la relación con Categoria
    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
