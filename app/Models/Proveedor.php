<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'Proveedor';
    protected $primaryKey = 'id_proveedor';
    public $timestamps = false;

    protected $fillable = [
        'proveedor',
    ];

    /**
     * Relación uno a muchos con Ejemplar.
     * Un Proveedor puede suministrar muchos Ejemplares.
     */
    public function ejemplares()
    {
        return $this->hasMany(Ejemplar::class, 'id_proveedor');
    }
}