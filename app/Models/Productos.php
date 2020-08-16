<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'idproducto';
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'marca',
        'descripcion',
        'precio',
        'precioventa',
    ];

    public function fotos()
    {
        return $this->hasOne('App\Models\Galery', 'idproducto', 'idproducto');
    }

    public function inventarioproducto()
    {
        return $this->hasMany('App\Models\Inventario', 'idproducto', 'idproducto');
    }

    public function carrito()
    {
        return $this->belongsTo('App\Models\Carrito', 'idproducto', 'idproducto');
    }

}
