<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion_clase extends Model
{
    protected $fillable = ['id_clase', 'id_usuario'];
    public $timestamps = false;

    // Definición de la relación con Clase
    public function clases()
    {
        return $this->belongsTo(Clase::class, 'id_clase');
    }

    // Definición de la relación con User
    public function users()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
