<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $table = 'Publisher';
    protected $primaryKey = 'id_publisher';
    public $timestamps = false;

    protected $fillable = [
        'publisher',
    ];

    /**
     * Relación uno a muchos con Catalogo.
     * Un Publisher puede tener muchos Catalogos.
     */
    public function catalogos()
    {
        return $this->hasMany(Catalogo::class, 'id_publisher');
    }
}
