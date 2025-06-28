<?php

// app/Models/Proveedor.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';
    public $timestamps = false;

    protected $fillable = ['proveedor'];

    public function ejemplares()
    {
        return $this->hasMany(Ejemplar::class, 'id_proveedor');
    }
}
