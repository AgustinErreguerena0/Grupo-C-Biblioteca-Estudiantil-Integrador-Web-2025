<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    protected $table = 'catalogos';
    protected $primaryKey = 'id_catalogo';
    public $timestamps = false;

    protected $fillable = [
        'title', 'description', 'date', 'type',
        'identifier', 'language', 'format', 'rights',
        'id_bibliotecario', 'id_publisher'
    ];

    public function bibliotecario()
    {
        return $this->belongsTo(Bibliotecario::class, 'id_bibliotecario');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'id_publisher');
    }

    public function ejemplares()
    {
        return $this->hasMany(Ejemplar::class, 'id_catalogo');
    }

    public function creators()
    {
        return $this->belongsToMany(Creator::class, 'catalogo_creator', 'id_catalogo', 'id_creator');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'catalogo_subject', 'id_catalogo', 'id_subject');
    }
}
