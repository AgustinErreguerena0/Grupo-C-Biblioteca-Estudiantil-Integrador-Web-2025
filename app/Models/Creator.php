<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    protected $table = 'creators';
    protected $primaryKey = 'id_creator';
    public $timestamps = false;

    protected $fillable = ['creator'];

    public function catalogos()
    {
        return $this->belongsToMany(Catalogo::class, 'catalogo_creator', 'id_creator', 'id_catalogo');
    }
}
