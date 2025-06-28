<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ejemplar extends Model
{
    use HasFactory;

    protected $table = 'Ejemplar';
    // La clave primaria es id_catalogo
    protected $primaryKey = 'id_catalogo';
    // Indicar que la clave primaria NO es autoincremental, ya que es una FK de Catalogo
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_catalogo',
        'ubicacion',
        'procedencia',
        'estado_material',
        'disponibilidad',
        'id_proveedor',
    ];

    /**
     * Relación muchos a uno con Catalogo.
     * Un Ejemplar pertenece a un Catalogo (su clave primaria es también una FK de Catalogo).
     */
    public function catalogo()
    {
        return $this->belongsTo(Catalogo::class, 'id_catalogo');
    }

    /**
     * Relación muchos a uno con Proveedor.
     * Un Ejemplar proviene de un Proveedor.
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}
