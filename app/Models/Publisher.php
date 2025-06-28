<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publishers';
    protected $primaryKey = 'id_publisher';
    public $timestamps = false;

    protected $fillable = ['publisher'];

    public function catalogos()
    {
        return $this->hasMany(Catalogo::class, 'id_publisher');
    }
}
