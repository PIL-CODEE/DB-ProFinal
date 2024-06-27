<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'id_tipo_usuario',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Definición de la relación con Tipo Usuario
    public function tipo_usuarios()
    {
        return $this->belongsTo(Tipo_usuario::class, 'id_tipo_usuario');
    }

    // Definición de la relación con Inscripción a clase
    public function inscripcion_clases()
    {
        return $this->hasMany(Inscripcion_clase::class, 'id_usuario');
    }

    // Definición de la relación con Inscripción a torneo
    public function inscripcion_torneo()
    {
        return $this->hasMany(Inscripcion_torneo::class, 'id_usuario');
    }
}
