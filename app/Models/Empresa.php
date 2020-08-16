<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey = 'idempresa';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'direccion',
        'razonsocial',
        'rfc',
        'telefono1',
        'telefono2',
        'correo',
        'descripcion'
    ];
}
