<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // Definimos los atributos que se pueden asignar en masa.
    protected $fillable = ['categoria', 'descripcion'];

    public $timestamps = false;

    // Definición de la relación con Clase
    public function clases()
    {
        return $this->hasMany(Clase::class, 'id_categoria');
    }
}
