<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    protected $fillable = ['id_categoria',
    'organizador',
    'nombre_torneo',
    'modalidad',
    'cupos_totales',
    'cupos_disponibles',
    'fecha_inicio',
    'hora_inicio',
    'costo_inscripcion',
    'estado'];

    public $timestamps = false;

    // Definición de la relación con Categoria
    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    // Definición de la relación con Inscripcion a torneos
    public function inscripcion_torneos()
    {
        return $this->hasMany(Inscripcion_torneo::class, 'id_torneo');
    }
}
