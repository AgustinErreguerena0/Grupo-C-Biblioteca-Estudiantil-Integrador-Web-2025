<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Miembro extends Model
{
    use HasFactory;

    protected $table = 'Miembro';
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
    ];

    /**
     * Relación uno a muchos con Prestamo.
     * Un Miembro puede tener muchos Prestamos.
     */
    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'id_miembro');
    }
}
