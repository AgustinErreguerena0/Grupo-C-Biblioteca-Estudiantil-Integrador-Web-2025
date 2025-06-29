<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejemplar extends Model
{
    protected $table = 'ejemplares';
    protected $primaryKey = 'id_ejemplar';
    public $timestamps = false;

    protected $fillable = [
        'id_ejemplar','id_publico', 'ubicacion', 'procedencia', 
        'estado_material', 'disponibilidad', 'id_catalogo','id_proveedor'
    ];

    public function catalogo()
    {
        return $this->belongsTo(Catalogo::class, 'id_ejemplar');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function prestamos()
    {
        return $this->belongsToMany(Prestamo::class, 'ejemplar_prestamo', 'id_ejemplar', 'id_prestamo');
    }
}
