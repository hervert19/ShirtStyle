<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idusuario';
    public $timestamps = false;

    protected $fillable = [
        'sesion',
        'nombre',
        'apellido',
        'telefono',
        'email',
        'direccion',
        'ciudad',
        'cp',
        'pais',
        'finalizo',
    ];

    public function articulos()
    {
        return $this->hasMany('App\Models\Carrito', 'idusuario', 'idusuario');
    }
}
