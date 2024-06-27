<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion_torneo extends Model
{
    protected $fillable = ['id_torneo', 'id_usuario', 'puntaje'];
    public $timestamps = false;

    // Definición de la relación con Torneo
    public function torneos()
    {
        return $this->belongsTo(Clase::class, 'id_torneo');
    }

    // Definición de la relación con User
    public function users()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
