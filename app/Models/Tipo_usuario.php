<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_usuario extends Model
{
    protected $fillable = ['tipo'];
    
    public $timestamps = false;

    // Definición de la relación con User
    public function users()
    {
        return $this->belongsTo(User::class, 'id_tipo_usuario');
    }
}
