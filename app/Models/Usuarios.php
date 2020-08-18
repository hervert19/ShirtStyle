<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idusuario';
    public $timestamps = true;

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
        'recibe',
        'recibetelefono',
        'recibedireccion',
        'recibeciudad',
        'recibecp',
        'recibepais',
        'registro',
        'finalizo',
        'created_at',
        'updated_at'
    ];

    public function articulos()
    {
        return $this->hasMany('App\Models\Carrito', 'idusuario', 'idusuario');
    }
}
