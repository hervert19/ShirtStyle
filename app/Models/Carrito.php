<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito';
    protected $primaryKey = 'idcarrito';
    public $timestamps = false;

    protected $fillable = [
        'idproducto',
        'idusuario',
        'cantidad',
        'idtalla'
    ];

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuarios', 'idusuario', 'idusuario');
    }

    public function producto()
    {
        return $this->hasOne('App\Models\Productos', 'idproducto', 'idproducto');
    }

    public function talla()
    {
        return $this->hasOne('App\Models\Tallas', 'idtalla', 'idtalla');
    }
}	 	 	