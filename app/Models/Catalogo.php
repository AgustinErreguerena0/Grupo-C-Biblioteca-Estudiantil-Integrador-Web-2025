<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    use HasFactory;

    protected $table = 'Catalogo';
    protected $primaryKey = 'id_catalogo';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'subject',
        'description',
        'date',
        'identifier',
        'language',
        'format',
        'rights',
        'type',
        'id_publisher',
    ];

    /**
     * Relación muchos a uno con Publisher.
     * Un Catalogo pertenece a un Publisher.
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'id_publisher');
    }

    /**
     * Relación muchos a muchos con Creator a través de la tabla Catalogo_Creator.
     * Un Catalogo puede tener varios Creators.
     */
    public function creators()
    {
        return $this->belongsToMany(Creator::class, 'Catalogo_Creator', 'id_catalogo', 'id_creator');
    }

    /**
     * Relación muchos a muchos con Subject a través de la tabla Catalogo_Subject.
     * Un Catalogo puede tener varios Subjects.
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'Catalogo_Subject', 'id_catalogo', 'id_subject');
    }

    /**
     * Relación uno a uno con Ejemplar.
     * Un Catalogo puede tener un Ejemplar (dado que id_catalogo es PK en Ejemplar).
     */
    public function ejemplar()
    {
        return $this->hasOne(Ejemplar::class, 'id_catalogo');
    }

    /**
     * Relación muchos a muchos con Prestamo a través de la tabla Ejemplar_Prestamo.
     * Un Catalogo puede estar en varios Prestamos.
     */
    public function prestamos()
    {
        return $this->belongsToMany(Prestamo::class, 'Ejemplar_Prestamo', 'id_catalogo', 'id_prestamo');
    }
}
