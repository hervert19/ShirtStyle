<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $table = 'pedidos';
    protected $primaryKey = 'idpedido';
    public $timestamps = true;

    protected $fillable = [
        'numpedido',
        'idusuario',
        'idenvio',
        'subtotal',
        'costoenvio',
        'total',
        'created_at',
        'updated_at'
    ];
}
