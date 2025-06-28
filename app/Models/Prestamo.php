<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $table = 'Prestamo';
    protected $primaryKey = 'id_prestamo';
    public $timestamps = false;

    protected $fillable = [
        'id_miembro',
        'fecha_prestamo',
        'devuelto',
    ];

    // Castear el campo 'fecha_prestamo' a tipo fecha y 'devuelto' a booleano
    protected $casts = [
        'fecha_prestamo' => 'date',
        'devuelto' => 'boolean',
    ];

    /**
     * Relación muchos a uno con Miembro.
     * Un Prestamo pertenece a un Miembro.
     */
    public function miembro()
    {
        return $this->belongsTo(Miembro::class, 'id_miembro');
    }

    /**
     * Relación muchos a muchos con Catalogo a través de la tabla Ejemplar_Prestamo.
     * Un Prestamo puede contener varios Catalogos/Ejemplares.
     */
    public function catalogos()
    {
        return $this->belongsToMany(Catalogo::class, 'Ejemplar_Prestamo', 'id_prestamo', 'id_catalogo');
    }
}