<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'Administrador';
    // Clave primaria de la tabla
    protected $primaryKey = 'id_administrador';
    // Desactivar timestamps automáticos (created_at, updated_at) ya que no están en la tabla
    public $timestamps = false;

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'apellido',
    ];
}
