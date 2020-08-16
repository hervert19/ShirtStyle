<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    protected $table = 'galeria';
    protected $primaryKey = 'idgaleria';
    public $timestamps = false;

    protected $fillable = [
        'idproducto',
        'imagen1',
        'imagen2',
        'imagen3',
        'imagen4',
        'imagen5',
    ];

    public function producto()
    {
        return $this->belongsTo('App\Models\Productos', 'idproducto', 'idproducto');
    }
}
