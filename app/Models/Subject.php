<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'Subject';
    protected $primaryKey = 'id_subject';
    public $timestamps = false;

    protected $fillable = [
        'subject',
    ];

    /**
     * Relación muchos a muchos con Catalogo a través de la tabla Catalogo_Subject.
     * Un Subject puede estar asociado a varios Catalogos.
     */
    public function catalogos()
    {
        return $this->belongsToMany(Catalogo::class, 'Catalogo_Subject', 'id_subject', 'id_catalogo');
    }
}