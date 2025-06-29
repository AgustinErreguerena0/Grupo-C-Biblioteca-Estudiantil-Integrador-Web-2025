<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bibliotecario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'bibliotecarios';
    protected $primaryKey = 'id_bibliotecario';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'correo',
        'telefono',
        'direccion',
        'usuario',
        'contraseña',
    ];

    protected $hidden = ['contraseña'];

    public function catalogos()
    {
        return $this->hasMany(Catalogo::class, 'id_bibliotecario');
    }
}
