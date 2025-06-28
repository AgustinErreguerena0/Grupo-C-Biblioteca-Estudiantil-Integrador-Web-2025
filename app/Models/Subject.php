<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id_subject';
    public $timestamps = false;

    protected $fillable = ['subject'];

    public function catalogos()
    {
        return $this->belongsToMany(Catalogo::class, 'catalogo_subject', 'id_subject', 'id_catalogo');
    }
}
