<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    use HasFactory;

    protected $table = 'Creator';
    protected $primaryKey = 'id_creator';
    public $timestamps = false;

    protected $fillable = [
        'creator',
    ];

    /**
     * Relación muchos a muchos con Catalogo a través de la tabla Catalogo_Creator.
     * Un Creator puede estar asociado a varios Catalogos.
     */
    public function catalogos()
    {
        // 'Catalogo_Creator' es el nombre de la tabla pivote
        // 'id_creator' es la clave foránea del modelo actual en la tabla pivote
        // 'id_catalogo' es la clave foránea del modelo relacionado en la tabla pivote
        return $this->belongsToMany(Catalogo::class, 'Catalogo_Creator', 'id_creator', 'id_catalogo');
    }
}
