<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tallas extends Model
{
    protected $table = 'tallas';
    protected $primaryKey = 'idtalla';
    public $timestamps = false;

    protected $fillable = [
        'medida',
        'descripcion',
    ];

    public function inventario()
    {
        return $this->belongsTo('App\Models\Tallas', 'idtalla', 'idtalla');
    }

    public function Carrito()
    {
        return $this->belongsTo('App\Models\Carrito', 'idtalla', 'idtalla');
    }
}
