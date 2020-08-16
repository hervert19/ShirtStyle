<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';
    protected $primaryKey = 'idinventario';
    public $timestamps = false;

    protected $fillable = [
        'idproducto',
        'idtalla',
        'disponible',
        'vendido',
    ];
    public function talla()
    {
        return $this->hasOne('App\Models\Tallas', 'idtalla', 'idtalla');
    }
}
