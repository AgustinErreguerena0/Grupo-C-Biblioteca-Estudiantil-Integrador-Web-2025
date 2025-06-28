<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bibliotecario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'bibliotecarios';
    protected $primaryKey = 'id_administrador';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellido',
        'contraseña',
    ];

    protected $hidden = ['contraseña'];

    public function catalogos()
    {
        return $this->hasMany(Catalogo::class, 'id_administrador');
    }
}
