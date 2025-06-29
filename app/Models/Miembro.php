<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Miembro extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'miembros';
    protected $primaryKey = 'id_miembro';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'correo',
        'telefono',
        'direccion',
        'tipo_miembro',
        'usuario',
        'contraseña',
    ];

    protected $hidden = ['contraseña'];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'id_miembro');
    }
     public function getAuthPassword()
    {
        return $this->contraseña;
    }
}
