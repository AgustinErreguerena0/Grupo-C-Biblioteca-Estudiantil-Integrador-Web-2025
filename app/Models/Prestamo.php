<?php
// app/Models/Prestamo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $table = 'prestamos';
    protected $primaryKey = 'id_prestamo';
    public $timestamps = false;

    protected $fillable = ['fecha_prestamo', 'devuelto', 'id_miembro'];

    public function ejemplares()
    {
        return $this->belongsToMany(Ejemplar::class, 'ejemplar_prestamo', 'id_prestamo', 'id_ejemplar');
    }

    public function miembro()
    {
        return $this->belongsTo(Miembro::class, 'id_miembro');
    }
}
